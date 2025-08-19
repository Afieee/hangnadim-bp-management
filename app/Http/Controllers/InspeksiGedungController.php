<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Gedung;
use App\Models\InspeksiGedung;
use Illuminate\Support\Facades\Auth;

class InspeksiGedungController extends Controller
{
    public function halamanInspeksi()
    {
        $gedungs = Gedung::all();
        return view('pages.jadwalkan-inspeksi', compact('gedungs'));
    }
    

public function store(Request $request)
{
    $userId = Auth::id(); // ambil user yang login

    InspeksiGedung::create([
        'furniture' => 'Belum Diperiksa', // default
        'fire_system' => 'Belum Diperiksa', // default
        'bangunan' => 'Belum Diperiksa', // default
        'mekanikal_elektrikal' => 'Belum Diperiksa', // default
        'it' => 'Belum Diperiksa', // default
        'status_keseluruhan_inspeksi' => 'Terbuka', // default
        'id_gedung' => $request->input('id_gedung'),
        'id_user' => $userId,
    ]);

    return redirect()->back()->with('success', 'Jadwal inspeksi berhasil dibuat!');
}








    public function halamanInspeksiPetugas()
    {
        $sekarang = Carbon::now()->locale('id'); // Waktu sekarang dengan lokal bahasa Indonesia
        $bulan = $sekarang->translatedFormat('F'); // Nama bulan
        $tahun = $sekarang->year;                  // Tahun saat ini
        $mingguKe = $sekarang->weekOfMonth;       // Minggu ke berapa dalam bulan

        $inspeksiGedungs = InspeksiGedung::with('gedung')
            ->where('status_keseluruhan_inspeksi', 'Terbuka')
            ->whereYear('created_at', $tahun)
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
        $inspeksi = InspeksiGedung::with('gedung', 'user')->findOrFail($id_inspeksi);
        return view('pages.detail-inspeksi-petugas', compact('inspeksi'));
    }


}
