<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PenjadwalanTamu;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Storage;

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
            'instansi' => 'required|string|max:255',
            'waktu_penggunaan_gedung' => 'nullable|date',
            'waktu_selesai_penggunaan_gedung' => 'nullable|date',
            'kode_penerbangan' => 'nullable|string|max:255',
            'kode_bandara_asal' => 'nullable|string|max:255',
            'lembar_disposisi' => 'nullable|mimes:pdf|max:20480',
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





    public function halamanFeedbackTamu($id)
    {
        try {
            $decryptedId = Crypt::decryptString($id);
            $tamu = PenjadwalanTamu::findOrFail($decryptedId);

            $feedback = $tamu->feedbacks()->first();

            return view('pages.feedback-tamu', [
                'tamu' => $tamu,
                'feedbackExists' => $feedback ? true : false,
                'feedback' => $feedback,
            ]);
        } catch (\Exception $e) {
            abort(404); // Jika ID tidak valid atau gagal dekripsi
        }
    }

    public function halamanEditPenjadwalan($encryptedId)
    {
        // decode URL (penting kalau ada %2B)
        $encryptedId = urldecode($encryptedId);

        // decrypt ID asli
        $id = Crypt::decryptString($encryptedId);

        // ambil data berdasarkan ID asli
        $penjadwalan = PenjadwalanTamu::findOrFail($id);

        // kirim ke view, beserta ID terenkripsi untuk form action
        return view('pages.edit-penjadwalan-tamu', [
            'penjadwalan' => $penjadwalan,
            'encryptedId' => $encryptedId
        ]);
    }

    // ✅ Proses Update Penjadwalan (dengan ID terenkripsi)
    public function updatePenjadwalan(Request $request, $encryptedId)
    {
        // decode URL (penting kalau ada %2B)
        $encryptedId = urldecode($encryptedId);

        // decrypt ID asli
        $id = Crypt::decryptString($encryptedId);

        // ambil data penjadwalan
        $penjadwalan = PenjadwalanTamu::findOrFail($id);

        // validasi input
        $validated = $request->validate([
            'level_tamu' => 'required',
            'subjek_tamu' => 'required|string|max:255',
            'instansi' => 'required|string|max:255',
            'waktu_penggunaan_gedung' => 'nullable|date',
            'waktu_selesai_penggunaan_gedung' => 'nullable|date',
            'kode_penerbangan' => 'nullable|string|max:255',
            'kode_bandara_asal' => 'nullable|string|max:255',
            'lembar_disposisi' => 'nullable|mimes:pdf|max:20480', // 20 MB
        ]);

        // handle file PDF
        if ($request->hasFile('lembar_disposisi')) {
            // simpan file baru ke storage/app/public/files
            $filePath = $request->file('lembar_disposisi')->store('files', 'public');
            $validated['lembar_disposisi'] = $filePath;
        } else {
            // gunakan input hidden sebagai fallback
            $validated['lembar_disposisi'] = $request->lembar_disposisi_lama ?? $penjadwalan->lembar_disposisi;
        }

        // update data
        $penjadwalan->update($validated);

        // redirect kembali ke daftar tamu
        return redirect()->route('tampil.manage.kedatangan')->with('success', 'Penjadwalan tamu berhasil diperbarui.');
    }
}
