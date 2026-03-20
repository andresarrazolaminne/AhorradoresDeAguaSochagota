<?php

use App\Http\Controllers\RegistroController;
use Illuminate\Support\Facades\Route;

$pathPrefix = (string) config('app.path_prefix', '');

$registerRoutes = function () {
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
};

if ($pathPrefix !== '') {
    Route::prefix($pathPrefix)->group($registerRoutes);
} else {
    $registerRoutes();
}
