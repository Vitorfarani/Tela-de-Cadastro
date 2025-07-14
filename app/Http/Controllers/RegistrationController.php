<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Carbon\Carbon;

class RegistrationController extends Controller
{
    /** Exibe formulário e lista */
    public function create()
    {
        $registrations = Registration::orderBy('created_at', 'desc')->get();
        return view('registrations.create', compact('registrations'));
    }

    /** Valida e armazena novo cadastro */
    public function store(Request $request)
    {
        $data = $this->validateData($request);

        // Formata data para Y-m-d
        $data['data_nascimento'] = Carbon::createFromFormat('d/m/Y', $data['data_nascimento'])
                                          ->format('Y-m-d');

        Registration::create($data);

        return redirect()->route('registrations.create')
                         ->with('success', 'Cadastro realizado com sucesso!');
    }

    /** Exibe formulário de edição */
    public function edit(Registration $registration)
    {
        return view('registrations.edit', compact('registration'));
    }

    /** Valida e atualiza cadastro existente */
    public function update(Request $request, Registration $registration)
    {
        $data = $this->validateData($request, $registration->id);

        // Formata data para Y-m-d
        $data['data_nascimento'] = Carbon::createFromFormat('d/m/Y', $data['data_nascimento'])
                                          ->format('Y-m-d');

        $registration->update($data);

        return redirect()->route('registrations.create')
                         ->with('success', 'Cadastro atualizado com sucesso!');
    }

    /** Remove registro */
    public function destroy(Registration $registration)
    {
        $registration->delete();
        return redirect()->route('registrations.create')
                         ->with('success', 'Registro excluído com sucesso!');
    }

    /**
     * Reúne regras de validação (store e update) e limpa máscaras.
     *
     * @param  Request  $request
     * @param  int|null $ignoreId
     * @return array
     */
    protected function validateData(Request $request, $ignoreId = null)
    {
        // Limpa máscara: deixa só dígitos em CPF e Telefone
        $request->merge([
            'cpf'      => preg_replace('/\D/', '', $request->input('cpf')),
            'telefone' => preg_replace('/\D/', '', $request->input('telefone')),
        ]);

        return $request->validate([
            'nome'            => 'required|string|max:255',
            'sexo'            => 'required|in:M,F,O',
            'telefone'        => ['required', 'digits_between:10,11'],
            'data_nascimento' => 'required|date_format:d/m/Y|before:today',
            'cpf'             => [
                'required',
                'digits:11',
                Rule::unique('registrations', 'cpf')->ignore($ignoreId),
                function($attribute, $value, $fail) {
                    // Não aceitar sequências de dígitos iguais
                    if (preg_match('/^(\d)\1{10}$/', $value)) {
                        return $fail('CPF inválido.');
                    }

                    // 1º dígito verificador
                    $sum = 0;
                    for ($i = 0; $i < 9; $i++) {
                        $sum += $value[$i] * (10 - $i);
                    }
                    $dv1 = ($sum * 10) % 11;
                    if ($dv1 === 10) {
                        $dv1 = 0;
                    }
                    if ($dv1 != $value[9]) {
                        return $fail('CPF inválido.');
                    }

                    // 2º dígito verificador
                    $sum = 0;
                    for ($i = 0; $i < 10; $i++) {
                        $sum += $value[$i] * (11 - $i);
                    }
                    $dv2 = ($sum * 10) % 11;
                    if ($dv2 === 10) {
                        $dv2 = 0;
                    }
                    if ($dv2 != $value[10]) {
                        return $fail('CPF inválido.');
                    }
                },
            ],
        ]);
    }
}
