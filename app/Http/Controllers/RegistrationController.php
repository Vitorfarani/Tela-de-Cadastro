<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use Carbon\Carbon;

class RegistrationController extends Controller
{
    /**
     * Exibe o formulário e a lista de cadastros.
     */
    public function create()
    {
        $registrations = Registration::orderBy('created_at', 'desc')->get();
        return view('registrations.create', compact('registrations'));
    }

    /**
     * Valida, converte a data e armazena no banco.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'nome'            => 'required|string|max:255',
            'sexo'            => 'required|in:M,F,O',
            'telefone'        => ['required','regex:/^\+?\d{10,15}$/'],
            'data_nascimento' => 'required|date_format:d/m/Y|before:today',
        ]);

        // converte 'dd/mm/aaaa' => 'aaaa-mm-dd' para o DB
        $data['data_nascimento'] = Carbon::createFromFormat('d/m/Y', $data['data_nascimento'])
                                         ->format('Y-m-d');

        Registration::create($data);

        return redirect()->back()->with('success', 'Cadastro realizado!');
    }
}
