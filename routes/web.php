<?php

use App\Models\PenjadwalanTamu;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\GedungController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\BuktiKerusakanController;
use App\Http\Controllers\BuktiPerbaikanController;
use App\Http\Controllers\InspeksiGedungController;
use App\Http\Controllers\PenjadwalanTamuController;

Route::get('/', function () {
    return view('auth.login');
});

Route::post('/proses-login', [AuthController::class, 'login'])->name('proses-login');


Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
    Route::get('dashboard', [AuthController::class, 'dashboard'])->name('dashboard');
    Route::post('dashboard/filter', [AuthController::class, 'filterDashboard'])->name('dashboard.filter');
    Route::post('dashboard/filter-damage-type', [AuthController::class, 'filterDamageType'])->name('dashboard.filter.damage');

    Route::get('/halaman-laporan-pribadi', [BuktiKerusakanController::class, 'halamanLaporanPribadi'])->name('laporan.pribadi');
    Route::post('/upload-bukti-kerusakan-pribadi', [BuktiKerusakanController::class, 'uploadBuktiKerusakanPribadi'])->name('bukti-kerusakan-pribadi.store');
    Route::get('/halaman-tindak-lanjut-laporan-pribadi', [BuktiPerbaikanController::class, 'halamanTindakLanjutPribadi'])->name('halaman.tindak.lanjut');

    Route::get('/halaman-rekapitulasi-kerusakan', [BuktiKerusakanController::class, 'halamanRekapitulasiKerusakan']);
    Route::get('/rekapitulasi-kerusakan/export', [BuktiKerusakanController::class, 'exportRekapitulasiKerusakan'])
        ->name('rekapitulasi.export');







    Route::get('profile/{id}', [AuthController::class, 'halamanEditProfilePribadi'])
        ->name('profile');

    Route::get('/halaman-registrasi', [AuthController::class, 'halamanRegister'])->name('halaman-registrasi');
    Route::post('/proses-registrasi', [AuthController::class, 'store'])->name('proses-registrasi');

    Route::get('/gedung', [GedungController::class, 'halamanTambahGedung'])->name('gedung.create');
    Route::post('/gedung/store', [GedungController::class, 'simpanGedung'])->name('gedung.store');
    Route::get('/halaman-tambah-asset', [GedungController::class, 'halamanTambahAsset'])->name('asset.create');
    Route::post('/asset-simpan', [GedungController::class, 'tambahAsset'])->name('asset.store');
    Route::get('/halaman-edit-asset/{id}', [GedungController::class, 'halamanEditAsset'])->name('asset.edit');
    Route::post('/asset-update/{id}', [GedungController::class, 'updateAsset'])->name('asset.update');
    Route::put('/asset-update/{id}', [GedungController::class, 'updateAsset']); // Untuk AJAX
    Route::delete('/asset-delete/{id}', [GedungController::class, 'hapusAsset'])->name('asset.delete');



    Route::get('/jadwalkan-inspeksi', [InspeksiGedungController::class, 'halamanInspeksi'])->name('jadwalkan.inspeksi');
    Route::post('/jadwalkan-inspeksi', [InspeksiGedungController::class, 'store'])->name('jadwalkan.inspeksi.store');

    Route::get('/halaman-inspeksi-petugas', [InspeksiGedungController::class, 'halamanInspeksiPetugas'])->name('halaman.inspeksi.petugas');

    Route::get('/halaman-upload-bukti-kerusakan', [BuktiKerusakanController::class, 'halamanUploadBuktiKerusakan'])->name('bukti-kerusakan.create');
    Route::post('/upload-bukti-kerusakan', [BuktiKerusakanController::class, 'uploadBuktiKerusakan'])->name('bukti-kerusakan.store');


    Route::post('/bukti-perbaikan/store', [BuktiPerbaikanController::class, 'store'])->name('bukti-perbaikan.store');
    Route::get('/manage-user', [AuthController::class, 'halamanManageUser'])->name('manage-user');
    Route::get('/halaman-manage-kedatangan', [PenjadwalanTamuController::class, 'halamanPenjadwalanTamu'])->name('halaman.manage.kedatangan');

    Route::get('/manage-kedatangan', [PenjadwalanTamuController::class, 'tampilPenjadwalanTamu'])->name('tampil.manage.kedatangan');
    Route::post('/penjadwalan-tamu', [PenjadwalanTamuController::class, 'simpanPenjadwalan'])->name('penjadwalan-tamu.store');

    Route::get('/halaman-manajemen-kerusakan-parah', [BuktiKerusakanController::class, 'halamanManajemenKerusakan'])->name('manajemen.kerusakan');

    // Aman
    Route::put('/inspeksi/{id}/update-field', [InspeksiGedungController::class, 'updateDetailInspeksi'])->name('inspeksi.update.field');


    // Berhasil
    Route::get('/manage-user/{id}/edit', [AuthController::class, 'halamanEditProfile'])->name('manage-user.edit');

    // Aman
    Route::put('/manage-user/{id}', [AuthController::class, 'updateProfile'])->name('manage-user.update');

    // Aman
    Route::delete('/manage-user/{id}', [AuthController::class, 'hapusUser'])->name('manage-user.delete');


    // Aman
    Route::put('/inspeksi-gedung/{id}/update-status', [InspeksiGedungController::class, 'updateStatus'])
        ->name('inspeksi-gedung.updateStatus');

    //
    Route::get('/halaman-upload-bukti-perbaikan/{id_buktiKerusakan}', [BuktiPerbaikanController::class, 'halamanUploadBuktiPerbaikan'])->name('bukti-perbaikan.create');
    //
    Route::get('/tampil-detail-inspeksi/{id_inspeksi}', [InspeksiGedungController::class, 'tampilDetailInspeksi'])->name('tampil.detail.inspeksi');


    Route::get('/tamu/{id}/edit', [PenjadwalanTamuController::class, 'halamanEditPenjadwalan'])
        ->where('id', '.*')
        ->name('pengunaan.edit');

    Route::post('/tamu/{id}/update', [PenjadwalanTamuController::class, 'updatePenjadwalan'])
        ->where('id', '.*')
        ->name('pengunaan.update');

    Route::post('dashboard/filter-guest-schedule', [AuthController::class, 'filterGuestSchedule'])->name('dashboard.filter.guest');
});















//
Route::get('/feedback.tamu/{id}', [PenjadwalanTamuController::class, 'halamanFeedbackTamu'])->name('halaman.feedback.tamu');


// Route untuk feedback
Route::post('/feedback/store', [FeedbackController::class, 'store'])->name('feedback.store');
Route::get('/feedback/thankyou', [FeedbackController::class, 'halamanTerimakasih'])->name('feedback.thankyou');
Route::get('/feedback/check-status/{id}', [FeedbackController::class, 'checkStatus'])->name('feedback.check-status');

// Pastikan route untuk form feedback menggunakan method POST
Route::post('/feedback-form', [FeedbackController::class, 'showForm'])->name('feedback.form');
Route::get('/halaman-data-feedback', [FeedbackController::class, 'halamanDataFeedback']);
