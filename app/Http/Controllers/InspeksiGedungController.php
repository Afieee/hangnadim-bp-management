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

        $gedungs = Gedung::all();

        foreach ($gedungs as $gedung) {
            InspeksiGedung::create([
                'status_access_door' => $request->input('status_access_door', 'belum diperiksa'),
                'status_cctv' => $request->input('status_cctv', 'belum diperiksa'),
                'status_lampu' => $request->input('status_lampu', 'belum diperiksa'),
                'status_keseluruhan_inspeksi' => 'Terbuka', // default tetap Terbuka
                'id_gedung' => $gedung->id,
                'id_user' => $userId,
            ]);
        }

        return redirect()->back()->with('success', 'Jadwal inspeksi berhasil dibuat untuk semua gedung!');
    }







    public function halamanInspeksiPetugas()
    {
        $sekarang = Carbon::now()->locale('id'); // Waktu sekarang dengan lokal bahasa Indonesia
        $bulan = $sekarang->translatedFormat('F'); // Nama bulan
        $tahun = $sekarang->year;                  // Tahun saat ini
        $mingguKe = $sekarang->weekOfMonth;       // Minggu ke berapa dalam bulan

        $inspeksiGedungs = InspeksiGedung::with('gedung')
            ->where('status_keseluruhan_inspeksi', 'Terbuka')
            ->whereMonth('created_at', $sekarang->month)
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
