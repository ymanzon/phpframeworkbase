<?php

use App\Http\Controllers\SecurityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InmuebleController;
use App\Http\Controllers\RolController;
use App\Http\Controllers\UsuarioController;


/*
Route::get('/', function () {
    return view('welcome');
})->name('home');*/
Route::get('/', [HomeController::class, 'welcome'])->name('home');


// Rutas de autenticación
Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rutas protegidas (requieren autenticación + permiso por acción).
// El middleware 'permiso:' revisa User::tienePermiso; el administrador
// pasa siempre. La API pública (/api/inmuebles) sigue abierta porque
// alimenta el catálogo de la página principal.
Route::middleware('auth')->group(function () {
    // Dashboard principal
    Route::get('/dashboard', [HomeController::class, 'dashboard'])
        ->middleware('permiso:dashboard.ver')->name('dashboard');

    // Inmuebles: ver, crear, editar y eliminar con permisos distintos.
    Route::get('/inmuebles', [InmuebleController::class, 'index'])
        ->middleware('permiso:inmuebles.ver')->name('inmuebles.index');
    Route::get('/inmuebles/create', [InmuebleController::class, 'create'])
        ->middleware('permiso:inmuebles.crear')->name('inmuebles.create');
    Route::post('/inmuebles', [InmuebleController::class, 'store'])
        ->middleware('permiso:inmuebles.crear')->name('inmuebles.store');
    Route::get('/inmuebles/{inmueble}', [InmuebleController::class, 'show'])
        ->middleware('permiso:inmuebles.ver')->name('inmuebles.show');
    Route::get('/inmuebles/{inmueble}/edit', [InmuebleController::class, 'edit'])
        ->middleware('permiso:inmuebles.editar')->name('inmuebles.edit');
    Route::put('/inmuebles/{inmueble}', [InmuebleController::class, 'update'])
        ->middleware('permiso:inmuebles.editar')->name('inmuebles.update');
    Route::delete('/inmuebles/{inmueble}', [InmuebleController::class, 'destroy'])
        ->middleware('permiso:inmuebles.eliminar')->name('inmuebles.destroy');

    // Ruta para eliminar foto específica
    Route::delete('/inmuebles/{inmueble}/foto/{index}', [InmuebleController::class, 'deleteFoto'])
        ->middleware('permiso:inmuebles.editar')->name('inmuebles.delete-foto');

    // Usuarios y roles: gestión con permisos por acción.
    Route::resource('usuarios', UsuarioController::class)
        ->only(['index'])->middleware('permiso:usuarios.ver');
    Route::resource('usuarios', UsuarioController::class)
        ->only(['create', 'store'])->middleware('permiso:usuarios.crear');
    Route::resource('usuarios', UsuarioController::class)
        ->only(['edit', 'update'])->middleware('permiso:usuarios.editar');
    Route::resource('usuarios', UsuarioController::class)
        ->only(['destroy'])->middleware('permiso:usuarios.eliminar');

    Route::resource('roles', RolController::class)
        ->only(['index'])->middleware('permiso:roles.ver');
    Route::resource('roles', RolController::class)
        ->only(['create', 'store'])->middleware('permiso:roles.crear');
    Route::resource('roles', RolController::class)
        ->only(['edit', 'update'])->middleware('permiso:roles.editar');
    Route::resource('roles', RolController::class)
        ->only(['destroy'])->middleware('permiso:roles.eliminar');
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
