<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use App\Rules\CpfValido;

class RegistrationRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'cpf'      => preg_replace('/\D/', '', $this->cpf),
            'telefone' => preg_replace('/\D/', '', $this->telefone),
        ]);
    }

    public function rules()
    {
        // Pega o ID quando for update
        $registrationId = $this->route('registration')?->id;

        return [
            'nome'            => ['required','string','min:3','max:255'],
            'sexo'            => ['required','in:M,F,O'],
            'telefone'        => ['required','digits_between:10,11'],
            'data_nascimento' => ['required','date_format:d/m/Y','before:today'],
            'cpf'             => [
                'required',
                'digits:11',
                Rule::unique('registrations','cpf')->ignore($registrationId),
                new CpfValido,
            ],
        ];
    }

    public function messages()
    {
        return [
            'nome.required'             => 'O nome é obrigatório.',
            'nome.min'                  => 'O nome deve ter ao menos 3 caracteres.',
            'sexo.required'             => 'O sexo é obrigatório.',
            'sexo.in'                   => 'Selecione um sexo válido.',
            'telefone.required'         => 'O telefone é obrigatório.',
            'telefone.digits_between'   => 'O telefone deve ter entre 10 e 11 dígitos.',
            'data_nascimento.required'  => 'A data de nascimento é obrigatória.',
            'data_nascimento.date_format'=> 'A data deve estar no formato dd/mm/aaaa.',
            'data_nascimento.before'    => 'A data de nascimento deve ser anterior a hoje.',
            'cpf.required'              => 'O CPF é obrigatório.',
            'cpf.digits'                => 'O CPF deve ter exatamente 11 dígitos.',
            'cpf.unique'                => 'Este CPF já está cadastrado.',
        ];
    }
}
