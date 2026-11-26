<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\InmueblesController;

Route::get('/inmuebles', [InmueblesController::class, 'index'])->name('api.inmuebles.index');
Route::get('/inmuebles/{id}', [InmueblesController::class, 'show'])->name('api.inmuebles.show');
