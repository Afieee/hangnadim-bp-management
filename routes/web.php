<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::post('/proses-login', [AuthController::class, 'login'])->name('proses-login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');   


Route::get('/halaman-registrasi', [AuthController::class, 'halamanRegister'])->name('halaman-registrasi');

Route::post('/proses-registrasi', [AuthController::class, 'store'])->name('proses-registrasi');