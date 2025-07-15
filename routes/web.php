<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistrationController;

// 1) quem acessar “/” é redirecionado para /registrations
Route::redirect('/', '/registrations');

// 2) o resource cria todas as rotas CRUD para /registrations
Route::resource('registrations', RegistrationController::class);
