<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('pages.dashboard');
});

Route::get('/halaman-registrasi', [AuthController::class, 'halamanRegister'])->name('halaman-registrasi');

Route::post('/proses-registrasi', [AuthController::class, 'store'])->name('proses-registrasi');