<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Aqui definimos as rotas do nosso CRUD de cadastros.
|
*/

// 1. Página inicial: exibe formulário de criação + lista de cadastros
Route::get('/', [RegistrationController::class, 'create'])
     ->name('registrations.create');

// 2. Armazena um novo cadastro
Route::post('/cadastro', [RegistrationController::class, 'store'])
     ->name('registrations.store');

// 3. Exibe o formulário de edição para um cadastro existente
Route::get('/cadastro/{registration}/edit', [RegistrationController::class, 'edit'])
     ->name('registrations.edit');

// 4. Atualiza o cadastro no banco
Route::put('/cadastro/{registration}', [RegistrationController::class, 'update'])
     ->name('registrations.update');

// 5. Exclui um cadastro
Route::delete('/cadastro/{registration}', [RegistrationController::class, 'destroy'])
     ->name('registrations.destroy');
