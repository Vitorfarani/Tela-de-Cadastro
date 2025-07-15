@csrf

<div class="row">
  <div class="col-md-6 mb-3">
    <label for="nome" class="form-label">Nome</label>
    <input type="text"
           id="nome"
           name="nome"
           class="form-control @error('nome') is-invalid @enderror"
           value="{{ old('nome', $registration->nome ?? '') }}"
           maxlength="255">
    @error('nome')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>

  <div class="col-md-3 mb-3">
    <label for="sexo" class="form-label">Sexo</label>
    <select id="sexo"
            name="sexo"
            class="form-select @error('sexo') is-invalid @enderror">
      <option value="">Selecione</option>
      <option value="M" {{ old('sexo', $registration->sexo ?? '')=='M' ? 'selected':'' }}>Masculino</option>
      <option value="F" {{ old('sexo', $registration->sexo ?? '')=='F' ? 'selected':'' }}>Feminino</option>
      <option value="O" {{ old('sexo', $registration->sexo ?? '')=='O' ? 'selected':'' }}>Outro</option>
    </select>
    @error('sexo')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>

  <div class="col-md-3 mb-3">
    <label for="telefone" class="form-label">Telefone</label>
    <input type="tel"
           id="telefone"
           name="telefone"
           class="form-control @error('telefone') is-invalid @enderror"
           value="{{ old('telefone', $registration->telefone ?? '') }}"
           maxlength="15"
           inputmode="tel"
           pattern="\(\d{2}\)\d{4,5}-\d{4}"
           placeholder="(00)00000-0000">
    @error('telefone')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
</div>

<div class="row">
  <div class="col-md-6 mb-3">
    <label for="cpf" class="form-label">CPF</label>
    <input type="tel"
           id="cpf"
           name="cpf"
           class="form-control @error('cpf') is-invalid @enderror"
           value="{{ old('cpf', $registration->cpf ?? '') }}"
           maxlength="14"
           inputmode="numeric"
           pattern="\d{3}\.\d{3}\.\d{3}-\d{2}"
           placeholder="000.000.000-00">
    @error('cpf')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>

  <div class="col-md-6 mb-3">
    <label for="data_nascimento" class="form-label">Data de Nascimento</label>
    <input type="tel"
           id="data_nascimento"
           name="data_nascimento"
           class="form-control @error('data_nascimento') is-invalid @enderror"
           value="{{ old('data_nascimento', isset($registration) ? $registration->data_nascimento->format('d/m/Y') : '') }}"
           maxlength="10"
           inputmode="numeric"
           pattern="\d{2}/\d{2}/\d{4}"
           placeholder="dd/mm/aaaa">
    @error('data_nascimento')<div class="invalid-feedback">{{ $message }}</div>@enderror
  </div>
</div>
