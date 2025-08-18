<?php

namespace App\Http\Controllers;


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

}
