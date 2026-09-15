<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LeaveController;
use App\Http\Controllers\AuthController;

// Rute Halaman Login (GET)
Route::get('/', [AuthController::class, 'showLogin'])->name('login')->middleware('guest');

// Rute Pemroses Data Login (POST) - Ini yang dituju oleh form
Route::post('/login', [AuthController::class, 'login']);

// Rute Logout
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Rute yang Membutuhkan Autentikasi
Route::middleware('auth')->group(function () {
    // Rute Profil Baru
    Route::get('/profil', [AuthController::class, 'profile'])->name('profil');
    Route::post('/profil/update', [AuthController::class, 'updateProfile'])->name('profil.update');

    // Rute Dashboard & Manajemen Pegawai
    Route::get('/dashboard', [LeaveController::class, 'index'])->name('dashboard');
    Route::post('/pegawai', [LeaveController::class, 'store'])->name('pegawai.store');
    Route::put('/pegawai/{id}', [LeaveController::class, 'update'])->name('pegawai.update');
    Route::delete('/pegawai/{id}', [LeaveController::class, 'destroy'])->name('pegawai.destroy');
    Route::post('/pegawai/{id}/saldo', [LeaveController::class, 'updateSaldo']);

    // Rute Manajemen Cuti
    Route::post('/cuti', [LeaveController::class, 'storeCuti'])->name('cuti.store');
    Route::delete('/cuti/{id}', [LeaveController::class, 'destroyCuti'])->name('cuti.destroy');
});
