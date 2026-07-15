<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\LineaController;

// Redirigir a login si no está autenticado
Route::get('/', function () {
    return redirect()->route('login');
});

// Rutas de Autenticación (Breeze)
require __DIR__ . '/auth.php';

// Rutas protegidas por login
Route::middleware('auth')->group(function () {

    // Dashboard principal (redirige según rol)
    Route::get('/dashboard', [DashboardController::class, 'index'])
        ->name('dashboard');

    // ==================== CRUD DE USUARIOS (Solo Admin) ====================
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('users', UserController::class);

        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
    });

    // ==================== CRUD DE LÍNEAS (Solo Admin) ====================
    Route::middleware('role:admin')->prefix('admin')->name('admin.')->group(function () {
        Route::resource('lineas', LineaController::class);
    });

    // Rutas de Perfil
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // ==================== RUTAS POR ROL ====================

    // Distribuidora
    Route::middleware('role:distribuidora')->prefix('distribuidora')->name('distribuidora.')->group(function () {
        Route::get('/dashboard', function () {
            return view('distribuidora.dashboard');
        })->name('dashboard');
    });

    // Mayorista
    Route::middleware('role:mayorista')->prefix('mayorista')->name('mayorista.')->group(function () {
        Route::get('/dashboard', function () {
            return view('mayorista.dashboard');
        })->name('dashboard');
    });

    // Minorista
    Route::middleware('role:minorista')->prefix('minorista')->name('minorista.')->group(function () {
        Route::get('/dashboard', function () {
            return view('minorista.dashboard');
        })->name('dashboard');
    });

    // Empleado
    Route::middleware('role:empleado')->prefix('empleado')->name('empleado.')->group(function () {
        Route::get('/dashboard', function () {
            return view('empleado.dashboard');
        })->name('dashboard');
    });
});