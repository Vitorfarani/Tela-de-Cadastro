@extends('layouts.app')

@section('title', 'Editar Cadastro')

@section('content')
  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <div class="card shadow-sm">
    <div class="card-body">
      <form id="form-edit"
            action="{{ route('registrations.update', $registration) }}"
            method="POST">
        @csrf
        @method('PUT')
        @include('registrations.form')
      </form>
    </div>
    <div class="card-footer">
      <button form="form-edit" class="btn btn-primary">Salvar Alterações</button>
      <a href="{{ route('registrations.index') }}" class="btn btn-secondary">
        Cancelar
      </a>
    </div>
  </div>
@endsection