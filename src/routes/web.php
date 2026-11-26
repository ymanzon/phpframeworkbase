<?php

use App\Http\Controllers\SecurityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InmuebleController;


/*
Route::get('/', function () {
    return view('welcome');
})->name('home');*/
Route::get('/', [HomeController::class, 'welcome'])->name('home');


// Rutas de autenticación
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas protegidas (requieren autenticación)
Route::middleware('auth')->group(function () {
    // Dashboard principal
    Route::get('/dashboard', [HomeController::class, 'dashboard'])->name('dashboard');
    
    // CRUD de Inmuebles
    Route::resource('inmuebles', InmuebleController::class);
    
    // Ruta para eliminar foto específica
    Route::delete('/inmuebles/{inmueble}/foto/{index}', [InmuebleController::class, 'deleteFoto'])->name('inmuebles.delete-foto');
});

//envio del correo electrónico para restablecer la contraseña
Route::get('/password/reset', [SecurityController::class, 'showResetForm'])->name('password.request');
Route::post('/password/reset', [SecurityController::class, 'reset'])->name('password.email');   
// Ruta para mostrar el formulario de restablecimiento de contraseña
// y para procesar el restablecimiento de contraseña
// (debe coincidir con el token enviado por correo electrónico)
Route::get('/password/change/{token}', [SecurityController::class, 'showChangeForm'])->name('password.reset');
Route::post('/password/change', [SecurityController::class, 'changePassword'])->name('password.update');

Route::get('/inmueble/detail/{id}', [InmuebleController::class, 'showDetail'])->name('inmuebles.detail');
