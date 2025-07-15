@extends('layouts.app')

@section('title', 'Lista de Cadastros')

@section('content')
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <!-- Busca por nome -->
  <form method="GET" action="{{ route('registrations.index') }}" class="mb-3">
    <div class="input-group">
      <input type="text" name="q"
             class="form-control"
             placeholder="Buscar por nome"
             value="{{ request('q') }}">
      <button class="btn btn-outline-secondary" type="submit">Buscar</button>
    </div>
  </form>

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
        @forelse($registrations as $r)
          <tr id="registro-{{ $r->id }}">
            <td>{{ $r->nome }}</td>
            <td>{{ ['M'=>'Masculino','F'=>'Feminino','O'=>'Outro'][$r->sexo] }}</td>
            <td>{{ $r->telefone_formatado }}</td>
            <td>{{ $r->cpf_formatado }}</td>
            <td>{{ $r->data_nascimento->format('d/m/Y') }}</td>
            <td>{{ $r->created_at->format('d/m/Y H:i') }}</td>
            <td>
              <a href="{{ route('registrations.edit', $r) }}"
                 class="btn btn-sm btn-primary">
                <i class="bi bi-pencil"></i>
              </a>
              <form action="{{ route('registrations.destroy', $r) }}"
                    method="POST"
                    class="d-inline"
                    onsubmit="return confirm('Tem certeza que deseja excluir este cadastro?');">
                @csrf
                @method('DELETE')
                <button class="btn btn-sm btn-danger">
                  <i class="bi bi-trash"></i>
                </button>
              </form>
            </td>
          </tr>
        @empty
          <tr>
            <td colspan="7" class="text-center">Nenhum registro encontrado.</td>
          </tr>
        @endforelse
      </tbody>
    </table>
  </div>

  <!-- Paginação -->
  <div class="mt-3">
    {{ $registrations->withQueryString()->links() }}
  </div>

  <!-- Botão Novo Cadastro -->
  <div class="mt-4">
    <a href="{{ route('registrations.create') }}" class="btn btn-success">
      Novo Cadastro
    </a>
  </div>
@endsection

@push('scripts')
<script>
  $(function(){
    $('input[name="cpf"]').mask('000.000.000-00');
    $('input[name="telefone"]').mask('(00)00000-0000');
    $('input[name="data_nascimento"]').mask('00/00/0000');
  });
</script>
@endpush
