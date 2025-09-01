<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Gedung;
use Illuminate\Http\Request;
use App\Models\BuktiKerusakan;
use App\Mail\LaporanPribadiMail;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class BuktiKerusakanController extends Controller
{
    public function halamanUploadBuktiKerusakan()
    {
        return view('bukti-kerusakan.create');
    }

public function uploadBuktiKerusakan(Request $request)
{
    $userId = Auth::id(); // ambil user yang logins

    $request->validate([
        'judul_bukti_kerusakan' => 'required|string|max:255',
        'deskripsi_bukti_kerusakan' => 'required|string',
        'lokasi_bukti_kerusakan' => 'required|string|max:255',
        'tipe_kerusakan' => 'required|string|in:Furniture,Fire System,Bangunan,Mekanikal Elektrikal,IT,Interior,Eksterior,Sanitasi',
        'file_bukti_kerusakan' => 'nullable|image|mimes:jpg,jpeg,png,webp,avif|max:2048',
        'id_inspeksi_gedung' => 'required|exists:inspeksi_gedung,id',
    ]);

    try {
        $filePath = null;
        if ($request->hasFile('file_bukti_kerusakan')) {
            $filePath = $request->file('file_bukti_kerusakan')->store('uploaded_photo', 'public');
        }
        
        BuktiKerusakan::create([
            'judul_bukti_kerusakan' => $request->judul_bukti_kerusakan,
            'deskripsi_bukti_kerusakan' => $request->deskripsi_bukti_kerusakan,
            'lokasi_bukti_kerusakan' => $request->lokasi_bukti_kerusakan,
            'tipe_kerusakan' => $request->tipe_kerusakan,
            'file_bukti_kerusakan' => $filePath,
            'id_inspeksi_gedung' => $request->id_inspeksi_gedung,
            'tipe_pelaporan'=> 'Laporan Mingguan' ,
            'id_user_inspektor' => $userId,
        ]);

        return back()->with('success', '✅ Bukti kerusakan berhasil diupload.');
    } catch (\Exception $e) {
        return back()->with('error', '❌ Gagal menyimpan data: ' . $e->getMessage());
    }
}



    public function halamanManajemenKerusakan()
    {
        // Menampilkan BuktiKerusakan yang belum memiliki relasi ke BuktiPerbaikan
        $kerusakanList = BuktiKerusakan::with(['inspeksiGedung.gedung', 'gedung', 'userInspektor'])
            ->whereDoesntHave('buktiPerbaikan')
            ->orderBy('created_at', 'asc')
            ->get();

        return view('pages.halaman-manajemen-kerusakan', compact('kerusakanList'));
    }



    public function halamanLaporanPribadi(){
        $gedungs = Gedung::all();
        return view('pages.laporan-pribadi', [
            'gedungs' => $gedungs,
        ]);
    }

















public function uploadBuktiKerusakanPribadi(Request $request)
{
    $userId = Auth::id();
    $userName = Auth::user()->name;

    $request->validate([
        'judul_bukti_kerusakan' => 'required|string|max:255',
        'deskripsi_bukti_kerusakan' => 'required|string',
        'lokasi_bukti_kerusakan' => 'required|string|max:255',
        'tipe_kerusakan' => 'required|string|in:Furniture,Fire System,Bangunan,Mekanikal Elektrikal,IT,Interior,Eksterior,Sanitasi',
        'file_bukti_kerusakan' => 'nullable|image|mimes:jpg,jpeg,png,webp,avif|max:2048',
        'id_inspeksi_gedung' => 'nullable',
        'id_gedung' => 'required',
    ]);

    try {
        $filePath = null;
        if ($request->hasFile('file_bukti_kerusakan')) {
            $filePath = $request->file('file_bukti_kerusakan')->store('uploaded_photo', 'public');
        }

        $bukti = BuktiKerusakan::create([
            'judul_bukti_kerusakan' => $request->judul_bukti_kerusakan,
            'deskripsi_bukti_kerusakan' => $request->deskripsi_bukti_kerusakan,
            'lokasi_bukti_kerusakan' => $request->lokasi_bukti_kerusakan,
            'tipe_kerusakan' => $request->tipe_kerusakan,
            'file_bukti_kerusakan' => $filePath,
            'id_gedung' => $request->id_gedung,
            'id_user_inspektor' => $userId,
            'tipe_pelaporan' => 'Laporan Pribadi',
            'id_inspeksi_gedung' => $request->id_inspeksi_gedung ?: null,
        ]);

        // 📌 Ambil semua email Kepala Seksi & Staff Pelaksana
        $recipients = User::whereIn('role', ['Kepala Seksi', 'Staff Pelaksana'])
                        ->pluck('email')
                        ->toArray();

        // Data untuk dikirim ke email
        $emailData = [
            'judul_bukti_kerusakan' => $request->judul_bukti_kerusakan,
            'deskripsi_bukti_kerusakan' => $request->deskripsi_bukti_kerusakan,
            'lokasi_bukti_kerusakan' => $request->lokasi_bukti_kerusakan,
            'tipe_kerusakan' => $request->tipe_kerusakan,
            'file_bukti_kerusakan' => $filePath,
            'id_gedung' => $request->id_gedung,
            'nama_pelapor' => $userName,
        ];

        // 📌 Kirim ke banyak penerima
        Mail::to($recipients)->send(new LaporanPribadiMail($emailData));

        return back()->with('success', '✅ Bukti kerusakan berhasil diupload & email terkirim ke semua Kepala Seksi dan Staff Pelaksana.');
    } catch (\Exception $e) {
        return back()->with('error', '❌ Gagal menyimpan data: ' . $e->getMessage());
    }
}


}
