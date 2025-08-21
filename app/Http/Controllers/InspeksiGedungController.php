<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Gedung;
use Illuminate\Http\Request;
use App\Models\BuktiKerusakan;
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
        'interior' => 'Belum Diperiksa', // default
        'eksterior' => 'Belum Diperiksa', // default
        'sanitasi' => 'Belum Diperiksa', // default
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

    $inspeksi = InspeksiGedung::findOrFail($id);
    $inspeksi->update([
        $request->field => $request->value
    ]);

    return response()->json(['message' => 'Berhasil diperbarui']);
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
