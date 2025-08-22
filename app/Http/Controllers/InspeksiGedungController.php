<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Gedung;
use Illuminate\Http\Request;
use App\Models\BuktiKerusakan;
use App\Models\InspeksiGedung;
use App\Mail\JadwalInspeksiMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class InspeksiGedungController extends Controller
{
    public function halamanInspeksi()
    {
        $gedungs = Gedung::all();
        return view('pages.jadwalkan-inspeksi', compact('gedungs'));
    }

     public function store(Request $request)
    {
        $userId = Auth::id();

        // Simpan data inspeksi baru
        $inspeksi = InspeksiGedung::create([
            'furniture' => 'Belum Diperiksa',
            'fire_system' => 'Belum Diperiksa',
            'bangunan' => 'Belum Diperiksa',
            'mekanikal_elektrikal' => 'Belum Diperiksa',
            'it' => 'Belum Diperiksa',
            'interior' => 'Belum Diperiksa',
            'eksterior' => 'Belum Diperiksa',
            'sanitasi' => 'Belum Diperiksa',
            'status_keseluruhan_inspeksi' => 'Terbuka',
            'id_gedung' => $request->input('id_gedung'),
            'id_user' => $userId,
        ]);

        $idInspeksiBaru = $inspeksi->id;

        // Ambil data inspeksi lengkap dengan relasi
        $informasiInspeksi = InspeksiGedung::with('gedung', 'user')
            ->findOrFail($idInspeksiBaru);

        // Ambil semua email staff pelaksana dan kepala seksi
        $staffs = User::whereIn('role', ['Staff Pelaksana', 'Kepala Seksi'])->get();

        // Kirim email
        foreach ($staffs as $staff) {
            Mail::to($staff->email)->send(new JadwalInspeksiMail($informasiInspeksi));
        }

        return redirect()->back()->with('success', 'Jadwal inspeksi berhasil dibuat dan notifikasi email telah dikirim!');
    }








    public function halamanInspeksiPetugas()
    {
        $sekarang = Carbon::now()->locale('id'); // Waktu sekarang dengan lokal bahasa Indonesia
        $bulan = $sekarang->translatedFormat('F'); // Nama bulan
        $tahun = $sekarang->year;                  // Tahun saat ini
        $mingguKe = $sekarang->weekOfMonth;       // Minggu ke berapa dalam bulan

        $inspeksiGedungs = InspeksiGedung::with('gedung')
            ->where('status_keseluruhan_inspeksi', 'Terbuka')
            ->get();

        return view('pages.inspeksi-petugas', [
            'inspeksi' => $inspeksiGedungs,
            'bulan' => $bulan,
            'tahun' => $tahun,
            'mingguKe' => $mingguKe,
        ]);
    }


    public function tampilDetailInspeksi($id_inspeksi)
    {
        $buktiKerusakans = BuktiKerusakan::where('id_inspeksi_gedung', $id_inspeksi)->get();
        $inspeksi = InspeksiGedung::with('gedung', 'user')->findOrFail($id_inspeksi);
        return view('pages.detail-inspeksi-petugas', [
            'inspeksi' => $inspeksi,
            'buktiKerusakans' => $buktiKerusakans,
        ]);
    }

public function updateDetailInspeksi(Request $request, $id)
{
    // Tangkap user yang sedang login
    $userLogin = Auth::user(); 
    $informasiPengubahStatus = InspeksiGedung::with('gedung', 'user')->findOrFail($id);

    // Validasi input
    $request->validate([
        'field' => 'required|string',
        'value' => 'required|string'
    ]);

    $allowedFields = [
        'furniture', 'fire_system', 'bangunan', 
        'mekanikal_elektrikal', 'it', 'interior', 
        'eksterior', 'sanitasi'
    ];

    if (!in_array($request->field, $allowedFields)) {
        return response()->json(['message' => 'Field tidak valid'], 400);
    }

    // Update data inspeksi
    $inspeksi = InspeksiGedung::findOrFail($id);
    $inspeksi->update([
        $request->field => $request->value
    ]);

    // Ambil semua user role Kepala Seksi
    $kepalaSeksiUsers = User::where('role', 'Kepala Seksi')->get();

    // Kirim email ke semua Kepala Seksi
    foreach ($kepalaSeksiUsers as $kepalaSeksi) {
        Mail::send('emails.pengubah_status_inspeksi', [
            'pengubah' => $userLogin->name,
            'emailPengubah' => $userLogin->email,
            'namaGedung' => $informasiPengubahStatus->gedung->nama_gedung ?? '-',
            'field' => ucfirst(str_replace('_', ' ', $request->field)),
            'nilaiBaru' => $request->value,
            'tanggalUpdate' => now()->format('d-m-Y H:i')
        ], function($message) use ($kepalaSeksi) {
            $message->to($kepalaSeksi->email)
                    ->subject('Pembaruan Status Inspeksi Gedung');
        });
    }

    return response()->json([
        'message' => 'Berhasil diperbarui dan email telah dikirim',
        'user_login' => $userLogin->name,
    ]);
}
















public function updateStatus(Request $request, $id)
{
    $request->validate([
        'status_keseluruhan_inspeksi' => 'required|string'
    ]);

    $inspeksi = \App\Models\InspeksiGedung::findOrFail($id);
    $inspeksi->status_keseluruhan_inspeksi = $request->status_keseluruhan_inspeksi;
    $inspeksi->save();

    return response()->json([
        'success' => true,
        'message' => 'Status berhasil diperbarui'
    ]);
}
}
