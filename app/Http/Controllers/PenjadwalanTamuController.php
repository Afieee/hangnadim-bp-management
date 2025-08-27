<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\PenjadwalanTamu;

class PenjadwalanTamuController extends Controller
{

    public function tampilPenjadwalanTamu(Request $request)
    {
        $search = $request->input('search');

        $tamu = PenjadwalanTamu::when($search, function ($query) use ($search) {
            $query->where('subjek_tamu', 'like', "%{$search}%")
                ->orWhere('level_tamu', 'like', "%{$search}%")
                ->orWhere('kode_penerbangan', 'like', "%{$search}%")
                ->orWhere('kode_bandara_asal', 'like', "%{$search}%")
                ->orWhereDate('waktu_tamu_berangkat', $search)
                ->orWhereDate('waktu_tamu_mendarat', $search);
        })
        ->orderBy('id', 'desc')
        ->paginate(4);

        return view('pages.manage-tamu', [
            'tamu' => $tamu,
            'search' => $search
        ]);
    }



    public function halamanPenjadwalanTamu()
    {
        return view('pages.penjadwalan-tamu');
    }



        public function simpanPenjadwalan(Request $request)
    {
        $validated = $request->validate([
            'level_tamu' => 'required',
            'subjek_tamu' => 'required|string|max:255',
            'waktu_tamu_berangkat' => 'nullable|date',
            'waktu_tamu_mendarat' => 'nullable|date',
            'kode_penerbangan' => 'nullable|string|max:255',
            'kode_bandara_asal' => 'nullable|string|max:255',
            'lembar_disposisi' => 'nullable|mimes:pdf|max:2048',
        ]);

        // Simpan file PDF jika ada
        if ($request->hasFile('lembar_disposisi')) {
            // Simpan di public/storage/files
            $filePath = $request->file('lembar_disposisi')->store('files', 'public');
            $validated['lembar_disposisi'] = $filePath;
        }


        // Set id_gedung dan id_user sesuai ketentuan
        $validated['id_gedung'] = 5;
        $validated['id_user'] = Auth::id();

        PenjadwalanTamu::create($validated);

        return redirect()->back()->with('success', 'Penjadwalan tamu berhasil disimpan.');
    }

}
