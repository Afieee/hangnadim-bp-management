<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Gedung;

class GedungController extends Controller
{
    /**
     * Tampilkan form tambah gedung
     */
    public function halamanTambahGedung()
    {
        return view('pages.tambah-gedung');
    }

    public function simpanGedung(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_gedung' => 'required|string|max:255',
            'foto_gedung' => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);

        $fotoPath = null;

        // Jika ada file foto_gedung diupload
        if ($request->hasFile('foto_gedung')) {
            $fotoName = time().'_'.$request->file('foto_gedung')->getClientOriginalName();
            $request->file('foto_gedung')->move(public_path('storage/uploaded_photo'), $fotoName);
            $fotoPath = 'storage/uploaded_photo/' . $fotoName;
        }

        // Simpan ke database
        Gedung::create([
            'nama_gedung' => $request->nama_gedung,
            'foto_gedung' => $fotoPath,
        ]);

        return redirect()->back()->with('success', 'Gedung berhasil ditambahkan!');
    }

}
