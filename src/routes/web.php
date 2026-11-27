<?php

use App\Http\Controllers\SecurityController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\InmuebleController;
use App\Http\Controllers\LeadController;


/*
Route::get('/', function () {
    return view('welcome');
})->name('home');*/
Route::get('/', [HomeController::class, 'welcome'])->name('home');

// Formulario público de contacto (guarda el lead y avisa por correo/Telegram)
Route::post('/contacto', [LeadController::class, 'store'])->name('contacto.enviar');

// Páginas legales (textos en config/inmobiliaria.php, clave 'textos')
Route::view('/aviso-de-privacidad', 'paginas.aviso-privacidad')->name('aviso-privacidad');
Route::view('/terminos', 'paginas.terminos')->name('terminos');


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

    // Leads del formulario de contacto (bandeja en el panel).
    // Requiere el middleware 'permiso:' del PR #2 (roles-permisos-usuarios):
    // fusionar ese PR ANTES que esta rama. Cuando el PR #2 esté fusionado,
    // crear el permiso 'leads.ver' en RolesPermisosSeeder y cambiar
    // 'permiso:dashboard.ver' por 'permiso:leads.ver' en estas dos rutas.
    Route::get('/leads', [LeadController::class, 'index'])->middleware('permiso:dashboard.ver')->name('leads.index');
    Route::patch('/leads/{lead}/leido', [LeadController::class, 'marcarLeido'])->middleware('permiso:dashboard.ver')->name('leads.marcar-leido');
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
