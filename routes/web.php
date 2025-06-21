<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KonsultasiController;

Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

Route::prefix('konsultasi')->name('konsultasi.')->group(function () {
    Route::get('/', [KonsultasiController::class, 'index'])->name('index');
    Route::get('/form', [KonsultasiController::class, 'form'])->name('form');
    Route::post('/proses', [KonsultasiController::class, 'proses'])->name('proses');
    Route::get('/riwayat', [KonsultasiController::class, 'riwayat'])->name('riwayat');
    Route::get('/detail/{id}', [KonsultasiController::class, 'detail'])->name('detail');
});

// Route::get('/', function () {
//     return view('welcome');
// });
