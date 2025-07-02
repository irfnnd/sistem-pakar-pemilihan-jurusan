<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\KonsultasiController;
use App\Http\Controllers\KonsultasiUserController;

Route::prefix('admin')->group(function () {

    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    Route::prefix('konsultasi')->name('konsultasi.')->group(function () {
        Route::get('/', [KonsultasiController::class, 'index'])->name('index');
        Route::get('/form', [KonsultasiController::class, 'form'])->name('form');
        Route::post('/proses', [KonsultasiController::class, 'proses'])->name('proses');
        Route::get('/riwayat', [KonsultasiController::class, 'riwayat'])->name('riwayat');
        Route::get('/detail/{id}', [KonsultasiController::class, 'detail'])->name('detail');
    });

});

Route::prefix('konsultasi')->name('konsultasi.')->group(function () {
    Route::get('/', [KonsultasiUserController::class, 'index'])->name('index');
    Route::get('/form', [KonsultasiUserController::class, 'form'])->name('form');
    Route::post('/proses', [KonsultasiUserController::class, 'proses'])->name('proses');
    Route::get('/riwayat', [KonsultasiUserController::class, 'riwayat'])->name('riwayat');
    Route::get('/detail/{id}', [KonsultasiUserController::class, 'detail'])->name('detail');
});

Route::get('/beranda', function () {
    return view('user.beranda');
})->name('beranda');

Route::get('/', function () {
    return view('user.beranda');
});
