@extends('layouts.app')

@section('title', 'Novo Cadastro')

@section('content')
  {{-- Mensagem de sucesso --}}
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="card shadow-sm mb-4">
    <div class="card-header"><h5 class="mb-0">Novo Cadastro</h5></div>
    <div class="card-body">
      <form action="{{ route('registrations.store') }}" method="POST">
        @csrf

        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Nome</label>
            <input type="text" name="nome" class="form-control" value="{{ old('nome') }}">
            @error('nome')<small class="text-danger">{{ $message }}</small>@enderror
          </div>

          <div class="col-md-3">
            <label class="form-label">Sexo</label>
            <select name="sexo" class="form-select">
              <option value="">Selecione</option>
              <option value="M" {{ old('sexo')=='M'?'selected':'' }}>Masculino</option>
              <option value="F" {{ old('sexo')=='F'?'selected':'' }}>Feminino</option>
              <option value="O" {{ old('sexo')=='O'?'selected':'' }}>Outro</option>
            </select>
            @error('sexo')<small class="text-danger">{{ $message }}</small>@enderror
          </div>

          <div class="col-md-3">
            <label class="form-label">Telefone</label>
            <input type="text" name="telefone" class="form-control" value="{{ old('telefone') }}">
            @error('telefone')<small class="text-danger">{{ $message }}</small>@enderror
          </div>

          <div class="col-md-3">
            <label class="form-label">CPF</label>
            <input type="text"
                   name="cpf"
                   class="form-control"
                   placeholder="000.000.000-00"
                   value="{{ old('cpf') }}">
            @error('cpf')<small class="text-danger">{{ $message }}</small>@enderror
          </div>

          <div class="col-md-3">
            <label class="form-label">Data de Nascimento</label>
            <input type="text"
                   name="data_nascimento"
                   class="form-control"
                   placeholder="dd/mm/aaaa"
                   value="{{ old('data_nascimento') }}">
            @error('data_nascimento')<small class="text-danger">{{ $message }}</small>@enderror
          </div>
        </div>

        <div class="mt-4">
          <button type="submit" class="btn btn-primary">Cadastrar</button>
        </div>
      </form>
    </div>
  </div>

  {{-- Tabela de cadastros --}}
  @if($registrations->isNotEmpty())
    <div class="card shadow-sm">
      <div class="card-header"><h5 class="mb-0">Usuários Cadastrados</h5></div>
      <div class="card-body p-0">
        <div class="table-responsive">
          <table class="table table-hover mb-0">
            <thead class="table-light">
              <tr>
                <th>Nome</th>
                <th>Sexo</th>
                <th>Telefone</th>
                <th>CPF</th>
                <th>Nascimento</th>
                <th>Cadastrado Em</th>
                <th>Ações</th>
              </tr>
            </thead>
            <tbody>
              @foreach($registrations as $r)
                <tr>
                  <td>{{ $r->nome }}</td>
                  <td>{{ $r->sexo }}</td>
                  <td>{{ $r->telefone }}</td>
                  <td>
                    {{ preg_replace(
                        '/(\d{3})(\d{3})(\d{3})(\d{2})/',
                        '$1.$2.$3-$4',
                        $r->cpf
                    ) }}
                  </td>
                  <td>{{ $r->data_nascimento->format('d/m/Y') }}</td>
                  <td>{{ $r->created_at->format('d/m/Y H:i') }}</td>
                  <td>
                    <a href="{{ route('registrations.edit', $r->id) }}"
                       class="btn btn-sm btn-secondary">Editar</a>

                    <form action="{{ route('registrations.destroy', $r->id) }}"
                          method="POST" class="d-inline"
                          onsubmit="return confirm('Excluir este registro?');">
                      @csrf
                      @method('DELETE')
                      <button class="btn btn-sm btn-danger">Excluir</button>
                    </form>
                  </td>
                </tr>
              @endforeach
            </tbody>
          </table>
        </div>
      </div>
    </div>
  @else
    <p class="text-center text-muted mt-4">Nenhum registro ainda.</p>
  @endif
@endsection

@push('scripts')
<script>
  $(function(){
    $('input[name="cpf"]').mask('000.000.000-00');
    $('input[name="telefone"]').mask('(00)00000-0000');
  });
</script>
@endpush
