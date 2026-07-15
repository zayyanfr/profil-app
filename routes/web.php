<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\MahasiswaController;
use App\Http\Controllers\TentangController;

// Route bawaan Laravel (biarkan tetap ada)
Route::get('/', function () {
    return view('welcome');
});

// Route baru yang kita tambahkan
Route::resource('mahasiswas', MahasiswaController::class);

Route::get('/tentang', [TentangController::class, 'index'])->name('tentang');