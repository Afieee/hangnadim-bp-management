<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\InspeksiGedungController;

Route::get('/', function () {
    return view('auth.login');
});

Route::post('/proses-login', [AuthController::class, 'login'])->name('proses-login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');   

Route::get('/halaman-registrasi', [AuthController::class, 'halamanRegister'])->name('halaman-registrasi');

Route::post('/proses-registrasi', [AuthController::class, 'store'])->name('proses-registrasi');

Route::get('/jadwalkan-inspeksi', [InspeksiGedungController::class, 'halamanInspeksi'])->name('jadwalkan.inspeksi');
Route::post('/jadwalkan-inspeksi', [InspeksiGedungController::class, 'store'])->name('jadwalkan.inspeksi.store');
Route::get('/halaman-inspeksi-petugas', [InspeksiGedungController::class, 'halamanInspeksiPetugas'])->name('halaman.inspeksi.petugas');
Route::get('/tampil-detail-inspeksi/{id_inspeksi}', [InspeksiGedungController::class, 'tampilDetailInspeksi'])->name('tampil.detail.inspeksi');