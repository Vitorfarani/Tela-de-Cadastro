<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Cadastro de Usuários</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.4.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
  <div class="container py-5">

    {{-- Mensagem de sucesso --}}
    @if(session('success'))
      <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    {{-- Formulário em card --}}
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

            <div class="col-md-4">
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
                  <th>Nascimento</th>
                  <th>Cadastrado Em</th>
                </tr>
              </thead>
              <tbody>
                @foreach($registrations as $r)
                  <tr>
                    <td>{{ $r->nome }}</td>
                    <td>{{ $r->sexo }}</td>
                    <td>{{ $r->telefone }}</td>
                    <td>{{ $r->data_nascimento->format('d/m/Y') }}</td>
                    <td>{{ $r->created_at->format('d/m/Y H:i') }}</td>
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

  </div>
</body>
</html>
