<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BuktiPerbaikan;
use App\Models\BuktiKerusakan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class BuktiPerbaikanController extends Controller
{
public function halamanUploadBuktiPerbaikan($id_buktiKerusakan)
{
    $id = \Illuminate\Support\Facades\Crypt::decryptString($id_buktiKerusakan);

    // Ambil data BuktiKerusakan
    $buktiKerusakan = BuktiKerusakan::findOrFail($id);

    // Ambil data BuktiPerbaikan
    $buktiPerbaikan = BuktiPerbaikan::where('id_bukti_kerusakan', $id)->get();

    // Pastikan path foto benar
    foreach ($buktiPerbaikan as $perbaikan) {
        if ($perbaikan->file_bukti_perbaikan) {
            if (str_contains($perbaikan->file_bukti_perbaikan, 'storage/')) {
                $perbaikan->url_foto = asset($perbaikan->file_bukti_perbaikan);
            } else {
                $perbaikan->url_foto = asset('storage/uploaded_photo/' . $perbaikan->file_bukti_perbaikan);
            }
        } else {
            $perbaikan->url_foto = null;
        }
    }

    return view('pages.halaman-upload-bukti-perbaikan', compact('buktiKerusakan', 'buktiPerbaikan'));
}



    public function store(Request $request)
    {
        $request->validate([
            'catatan_bukti_perbaikan' => 'required|string',
            'file_bukti_perbaikan' => 'required|file|mimes:jpeg,png,jpg,gif,webp,pdf|max:2048',
            'id_bukti_kerusakan' => 'required|exists:bukti_kerusakan,id',
            'id_user_inspektor' => 'required|integer'
        ]);


        try {
            $filePath = null;

            // Simpan file ke public/storage/uploaded_photo
            if ($request->hasFile('file_bukti_perbaikan')) {
                $file = $request->file('file_bukti_perbaikan');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $file->move(public_path('storage/uploaded_photo'), $fileName);
                $filePath = 'storage/uploaded_photo/' . $fileName;
            }

            // Simpan data bukti perbaikan
            BuktiPerbaikan::create([
                'catatan_bukti_perbaikan' => $request->catatan_bukti_perbaikan,
                'file_bukti_perbaikan' => $filePath,
                'id_bukti_kerusakan' => $request->id_bukti_kerusakan,
                'id_user_inspektor' => $request->id_user_inspektor
            ]);

            // Update status pada bukti kerusakan terkait
            $buktiKerusakan = BuktiKerusakan::find($request->id_bukti_kerusakan);
            if ($buktiKerusakan) {
                $buktiKerusakan->status_perbaikan = 'sudah_diperbaiki';
                $buktiKerusakan->save();
            }

            return redirect()->back()->with('success', 'Bukti perbaikan berhasil disimpan.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Terjadi kesalahan: ' . $e->getMessage());
        }
    }



    public function halamanTindakLanjutPribadi()
    {
        $buktiKerusakanPribadi = BuktiKerusakan::with(['userInspektor', 'gedung', 'buktiPerbaikan'])
            ->whereNull('id_inspeksi_gedung')
            ->withCount('buktiPerbaikan')
            ->orderBy('bukti_perbaikan_count', 'asc')
            ->orderBy('created_at', 'desc')
            ->paginate(2); // Ubah get() menjadi paginate()

        return view('pages.tindak-laporan-pribadi', [
            'buktiKerusakanPribadi' => $buktiKerusakanPribadi,
        ]);
    }







}