<?php

use App\Http\Controllers\RegistrationController;

Route::get('/', [RegistrationController::class, 'create']);
Route::post('/cadastro', [RegistrationController::class, 'store'])->name('registrations.store');
