<?php

namespace App\Http\Controllers;

use App\Models\Gedung;
use Illuminate\Http\Request;
use App\Models\InspeksiGedung;
use Illuminate\Support\Facades\Storage;

class GedungController extends Controller
{
    /**
     * Tampilkan form tambah gedung
     */
    public function halamanTambahGedung()
    {
        // Ambil semua data gedung dari database
        $gedungs = Gedung::all();

        // Jika Anda masih pakai array inspeksi terbuka
        $gedungDenganInspeksiTerbuka = InspeksiGedung::where('status', 'terbuka')
            ->pluck('id_gedung')
            ->toArray();

        return view('pages.tambah-gedung', compact('gedungs', 'gedungDenganInspeksiTerbuka'));
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
            $fotoName = time() . '_' . $request->file('foto_gedung')->getClientOriginalName();
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


    public function halamanTambahAsset()
    {
        return view('pages.tambah-asset');
    }

    public function tambahAsset(Request $request)
    {
        // Validasi input
        $request->validate([
            'nama_gedung' => 'required|string|max:255',
            'foto_gedung' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $fotoPath = null;

        // Kalau ada file yang diupload
        if ($request->hasFile('foto_gedung')) {
            $fotoPath = $request->file('foto_gedung')->store('assets', 'public');
        }

        // Simpan ke database
        Gedung::create([
            'nama_gedung' => $request->nama_gedung,
            'foto_gedung' => $fotoPath,
        ]);

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Asset berhasil ditambahkan!']);
        }

        return redirect()->back()->with('success', 'Asset berhasil ditambahkan!');
    }


    public function halamanEditAsset($id)
    {
        $gedung = Gedung::findOrFail($id);
        return view('pages.ubah-informasi-asset', compact('gedung'));
    }
    public function updateAsset(Request $request, $id)
    {
        // Validasi input
        $request->validate([
            'nama_gedung' => 'required|string|max:255',
            'foto_gedung' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $gedung = Gedung::findOrFail($id);

        // Kalau ada file yang diupload
        if ($request->hasFile('foto_gedung')) {
            // Hapus foto lama jika ada
            if ($gedung->foto_gedung && Storage::disk('public')->exists($gedung->foto_gedung)) {
                Storage::disk('public')->delete($gedung->foto_gedung);
            }

            // Simpan file baru
            $fotoPath = $request->file('foto_gedung')->store('assets', 'public');
            $gedung->foto_gedung = $fotoPath;
        }

        // Update nama gedung
        $gedung->nama_gedung = $request->nama_gedung;
        $gedung->save();

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => 'Informasi asset berhasil diperbarui!']);
        }

        return redirect()->route('jadwalkan.inspeksi')->with('success', 'Informasi asset berhasil diperbarui!');
    }

    public function hapusAsset($id)
    {
        $gedung = Gedung::findOrFail($id);
        $gedung->delete();

        return redirect()->back()->with('success', 'Asset berhasil dihapus!');
    }
}
