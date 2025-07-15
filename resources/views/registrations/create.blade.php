@extends('layouts.app')

@section('title', 'Novo Cadastro')

@section('content')
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="card shadow-sm">
    <div class="card-body">
      <form id="form-cadastro"
            action="{{ route('registrations.store') }}"
            method="POST">
        @include('registrations.form')
      </form>
    </div>
    <div class="card-footer">
      <button form="form-cadastro" class="btn btn-primary">Cadastrar</button>
      <a href="{{ route('registrations.index') }}" class="btn btn-secondary">
        Voltar
      </a>
    </div>
  </div>
@endsection
