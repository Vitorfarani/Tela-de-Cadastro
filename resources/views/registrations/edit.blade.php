@extends('layouts.app')

@section('title', 'Editar Cadastro')

@section('content')
  {{-- Mensagem de sucesso --}}
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="card shadow-sm">
    <div class="card-header">
      <h5 class="mb-0">Editar Cadastro de {{ $registration->nome }}</h5>
    </div>
    <div class="card-body">
      <form action="{{ route('registrations.update', $registration->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="row g-3">
          <div class="col-md-6">
            <label class="form-label">Nome</label>
            <input type="text"
                   name="nome"
                   class="form-control"
                   value="{{ old('nome', $registration->nome) }}">
            @error('nome')<small class="text-danger">{{ $message }}</small>@enderror
          </div>

          <div class="col-md-3">
            <label class="form-label">Sexo</label>
            <select name="sexo" class="form-select">
              <option value="">Selecione</option>
              <option value="M" {{ old('sexo', $registration->sexo)=='M' ? 'selected':'' }}>Masculino</option>
              <option value="F" {{ old('sexo', $registration->sexo)=='F' ? 'selected':'' }}>Feminino</option>
              <option value="O" {{ old('sexo', $registration->sexo)=='O' ? 'selected':'' }}>Outro</option>
            </select>
            @error('sexo')<small class="text-danger">{{ $message }}</small>@enderror
          </div>

          <div class="col-md-3">
            <label class="form-label">Telefone</label>
            <input type="text"
                   name="telefone"
                   class="form-control"
                   value="{{ old('telefone', $registration->telefone) }}">
            @error('telefone')<small class="text-danger">{{ $message }}</small>@enderror
          </div>

          <div class="col-md-3">
            <label class="form-label">CPF</label>
            <input type="text"
                   name="cpf"
                   class="form-control"
                   placeholder="000.000.000-00"
                   value="{{ old('cpf', $registration->cpf) }}">
            @error('cpf')<small class="text-danger">{{ $message }}</small>@enderror
          </div>

          <div class="col-md-3">
            <label class="form-label">Data de Nascimento</label>
            <input type="text"
                   name="data_nascimento"
                   class="form-control"
                   placeholder="dd/mm/aaaa"
                   value="{{ old('data_nascimento', $registration->data_nascimento->format('d/m/Y')) }}">
            @error('data_nascimento')<small class="text-danger">{{ $message }}</small>@enderror
          </div>
        </div>

        <div class="mt-4">
          <button type="submit" class="btn btn-primary">Salvar Alterações</button>
          <a href="{{ route('registrations.create') }}" class="btn btn-secondary">Cancelar</a>
        </div>
      </form>
    </div>
  </div>
@endsection

@push('scripts')
<script>
  $(function(){
    $('input[name="cpf"]').mask('000.000.000-00');
    $('input[name="telefone"]').mask('(00)00000-0000');
  });
</script>
@endpush
