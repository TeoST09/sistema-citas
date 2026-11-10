<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\MascotasController;
use App\Http\Controllers\ReservasController;
use App\Http\Controllers\ServiciosAdminController;
use App\Http\Controllers\ServiciosController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/register', function () {
    return view('auth.register');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::post('/register', [RegisterController::class, 'register'])->name('register');
Route::post('/logueado', [LoginController::class, 'login'])->name('login.submit');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
    Route::get('/settings', [UserController::class, 'editSettings'])->name('settings');
    Route::put('/settings', [UserController::class, 'updateSettings'])->name('settings.update');
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    Route::resource('mascotas', MascotasController::class);
    Route::resource('servicios_admin', ServiciosAdminController::class)->middleware('role');
    Route::resource('/servicios', ServiciosController::class);
    Route::resource('/reservas', ReservasController::class);
    Route::resource('/usuarios', UserController::class);
});