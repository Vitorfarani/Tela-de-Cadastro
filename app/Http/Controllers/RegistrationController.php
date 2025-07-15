<?php

namespace App\Http\Controllers;

use App\Models\Registration;
use Illuminate\Http\Request;
use App\Http\Requests\RegistrationRequest;
use Carbon\Carbon;

class RegistrationController extends Controller
{
    // 1. Listagem + busca
    public function index(Request $request)
    {
        $query = Registration::query();
        if ($request->filled('q')) {
            $query->where('nome', 'like', '%'.$request->q.'%');
        }
        $registrations = $query->orderBy('created_at','desc')->paginate(10);
        return view('registrations.index', compact('registrations'));
    }

    // 2. Formulário vazio
    public function create()
    {
        return view('registrations.create');
    }

    // 3. Armazena novo
    public function store(RegistrationRequest $request)
    {
        $data = $request->validated();
        $data['data_nascimento'] = Carbon::createFromFormat('d/m/Y', $data['data_nascimento'])
                                          ->format('Y-m-d');
        Registration::create($data);
        return redirect()->route('registrations.index')
                         ->with('success','Cadastro realizado com sucesso!');
    }

    // 4. Formulário de edição
    public function edit(Registration $registration)
    {
        return view('registrations.edit', compact('registration'));
    }

    // 5. Atualiza existente
    public function update(RegistrationRequest $request, Registration $registration)
    {
        $data = $request->validated();
        $data['data_nascimento'] = Carbon::createFromFormat('d/m/Y', $data['data_nascimento'])
                                          ->format('Y-m-d');
        $registration->update($data);
        return redirect()->route('registrations.index')
                         ->with('success','Cadastro atualizado com sucesso!');
    }

    // 6. Exclui
    public function destroy(Registration $registration)
    {
        $registration->delete();
        return redirect()->route('registrations.index')
                         ->with('success','Cadastro excluído com sucesso!');
    }
}
