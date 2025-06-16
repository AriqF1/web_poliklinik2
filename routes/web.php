<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Dokter\DokterController;
use App\Http\Controllers\Pasien\PasienController;
use App\Http\Controllers\Admin\PoliController;
use App\Http\Controllers\Dokter\JadwalPeriksaController;
use App\Http\Controllers\Dokter\PeriksaController;

Route::get('/', function () {
    return view('landing.welcome');
});

Route::get('/login', [LoginController::class, 'index'])->name('login'); // Form login
Route::post('/login', [LoginController::class, 'login'])->name('login.submit'); // Proses login

Route::get('/register', [RegisterController::class, 'index'])->name('register'); // Form register
Route::post('/register', [RegisterController::class, 'register'])->name('register.submit'); // Proses register

Route::prefix('pasien')
    ->name('pasien.')
    ->middleware(['auth', 'role:pasien'])
    ->group(function () {
        Route::get('/dashboard', [PasienController::class, 'index'])->name('index');
        Route::get('/poli', [PoliController::class, 'index'])->name('poli.index');
        Route::post('/poli/daftar-poli', [PoliController::class, 'store'])->name('poli.daftar-poli.store');
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout'); // Proses logout
    });

Route::prefix('dokter')
    ->name('dokter.')
    ->middleware(['auth', 'role:dokter'])
    ->group(function () {
        Route::get('/dashboard', [DokterController::class, 'index'])->name('index');
        Route::get('/jadwal-periksa', [JadwalPeriksaController::class, 'index'])->name('poli.index');
        Route::get('/periksa', [PeriksaController::class, 'index'])->name('periksa.index');
        Route::get('/riwayat-periksa', [PeriksaController::class, 'riwayat'])->name('riwayat.index');
        Route::post('/periksa', [PeriksaController::class, 'store'])->name('periksa.store');
        Route::post('/create/jadwal-periksa', [JadwalPeriksaController::class, 'store'])->name('jadwal.store');
        Route::post('/logout', [LoginController::class, 'logout'])->name('logout'); // Proses logout
    });
