<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GedungController;
use App\Http\Controllers\BuktiKerusakanController;
use App\Http\Controllers\BuktiPerbaikanController;
use App\Http\Controllers\InspeksiGedungController;

Route::get('/', function () {
    return view('auth.login');
});

Route::post('/proses-login', [AuthController::class, 'login'])->name('proses-login');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');


Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');   

Route::get('/halaman-registrasi', [AuthController::class, 'halamanRegister'])->name('halaman-registrasi');
Route::post('/proses-registrasi', [AuthController::class, 'store'])->name('proses-registrasi');

Route::get('/gedung', [GedungController::class, 'halamanTambahGedung'])->name('gedung.create');
Route::post('/gedung/store', [GedungController::class, 'simpanGedung'])->name('gedung.store');


Route::get('/jadwalkan-inspeksi', [InspeksiGedungController::class, 'halamanInspeksi'])->name('jadwalkan.inspeksi');
Route::post('/jadwalkan-inspeksi', [InspeksiGedungController::class, 'store'])->name('jadwalkan.inspeksi.store');
Route::put('/inspeksi/{id}/update-field', [InspeksiGedungController::class, 'updateDetailInspeksi'])->name('inspeksi.update.field');

Route::get('/halaman-inspeksi-petugas', [InspeksiGedungController::class, 'halamanInspeksiPetugas'])->name('halaman.inspeksi.petugas');
Route::get('/tampil-detail-inspeksi/{id_inspeksi}', [InspeksiGedungController::class, 'tampilDetailInspeksi'])->name('tampil.detail.inspeksi');

Route::get('/halaman-upload-bukti-kerusakan', [BuktiKerusakanController::class, 'halamanUploadBuktiKerusakan'])->name('bukti-kerusakan.create');
Route::post('/upload-bukti-kerusakan', [BuktiKerusakanController::class, 'uploadBuktiKerusakan'])->name('bukti-kerusakan.store');


Route::get('/halaman-upload-bukti-perbaikan/{id_buktiKerusakan}', [BuktiPerbaikanController::class, 'halamanUploadBuktiPerbaikan'])->name('bukti-perbaikan.create');
Route::post('/bukti-perbaikan/store', [BuktiPerbaikanController::class, 'store'])->name('bukti-perbaikan.store');

Route::put('/inspeksi-gedung/{id}/update-status', [App\Http\Controllers\InspeksiGedungController::class, 'updateStatus'])
    ->name('inspeksi-gedung.updateStatus');
