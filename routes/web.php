<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegistroController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/registro', function () {
    return view('auth.register');
})->name('registro.create');

Route::post('/registro', [RegistroController::class, 'store'])->name('registro.store');

Route::get('/registro/expectativa', function () {
    return view('auth.registro_expectativa');
})->name('registro.expectativa');
