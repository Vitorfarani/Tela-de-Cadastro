<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title') - Cadastro TI‑Proderj</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
</head>
<body class="bg-light"><!-- opcionalmente mantenha o bg-light -->

<nav class="navbar navbar-expand-lg navbar-dark bg-primary mb-4">
  <div class="container">
    <a class="navbar-brand" href="{{ route('registrations.index') }}">Cadastro TI‑Proderj</a>
  </div>
</nav>

<div class="container">
  @yield('content')
</div>

{{-- jQuery primeiro --}}
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
{{-- plugin de máscaras --}}
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>
{{-- Bootstrap JS --}}
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
  // máscara global para todos os formulários
  $(function(){
    $('input[name="cpf"]').mask('000.000.000-00');
    $('input[name="telefone"]').mask('(00)00000-0000');
    $('input[name="data_nascimento"]').mask('00/00/0000');
  });
</script>

@stack('scripts')
</body>
</html>
