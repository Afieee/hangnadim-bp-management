<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;
use App\Models\KerusakanKendaraan;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Models\PerbaikanKerusakanKendaraan;
use Illuminate\Contracts\Encryption\DecryptException;


class KerusakanKendaraanController extends Controller
{
    public function halamanLaporanKerusakanKendaraan()
    {
        $listKendaraan = Kendaraan::all();
        return view('kendaraan.laporkan-kerusakan-kendaraan', [
            'listKendaraan' => $listKendaraan
        ]);
    }

    public function simpanLaporanKerusakanKendaraan(Request $request)
    {
        try {
            // Validasi data
            $validated = $request->validate([
                'id_kendaraan' => 'required|exists:kendaraan,id',
                'objek_kerusakan' => 'required|string|max:255',
                'tipe_kerusakan' => 'required|string|max:255',
                'deskripsi_kerusakan' => 'required|string',
                'foto_kerusakan' => 'required|image|mimes:jpeg,png,jpg,webp,avif|max:10240',
                'status_kerusakan' => 'required|in:Ringan,Sedang,Parah',
            ]);

            // Tambah user ID dari auth
            $validated['id_user'] = Auth::id();

            // Handle file upload
            if ($request->hasFile('foto_kerusakan')) {
                $file = $request->file('foto_kerusakan');
                $filename = time() . '_' . uniqid() . '.' . $file->getClientOriginalExtension();
                $path = $file->storeAs('kerusakan_kendaraan', $filename, 'public');
                $validated['foto_kerusakan'] = $path;

                Log::info('File uploaded successfully: ' . $path);
            }

            // Simpan ke database
            $kerusakan = KerusakanKendaraan::create($validated);

            Log::info('Laporan kerusakan berhasil disimpan dengan ID: ' . $kerusakan->id);

            // Response untuk AJAX request
            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Laporan kerusakan kendaraan berhasil disimpan.',
                    'data' => $kerusakan
                ]);
            }

            // Response untuk regular request
            return redirect()->back()->with('success', 'Laporan kerusakan kendaraan berhasil disimpan.');
        } catch (\Illuminate\Validation\ValidationException $e) {
            Log::error('Validation error: ', $e->errors());

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Validasi gagal',
                    'errors' => $e->errors()
                ], 422);
            }

            return redirect()->back()
                ->withErrors($e->errors())
                ->withInput();
        } catch (\Exception $e) {
            Log::error('Error saving damage report: ' . $e->getMessage());

            if ($request->ajax()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Terjadi kesalahan sistem: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()
                ->with('error', 'Terjadi kesalahan sistem: ' . $e->getMessage())
                ->withInput();
        }
    }

    public function halamanTindakLanjutKerusakanKendaraan()
    {
        $userId = Auth::id(); // Ambil ID user yang login

        // Ambil data kerusakan kendaraan milik user dan urutkan:
        // yang BELUM punya perbaikan muncul di atas
        $kerusakanList = KerusakanKendaraan::with(['kendaraan', 'user', 'perbaikanKerusakanKendaraan'])
            // ->where('id_user', $userId)
            ->orderByRaw('
            CASE
                WHEN (SELECT COUNT(*) FROM perbaikan_kerusakan_kendaraan
                      WHERE perbaikan_kerusakan_kendaraan.id_kerusakan_kendaraan = kerusakan_kendaraan.id) = 0
                THEN 0 ELSE 1
            END ASC
        ')
            ->orderBy('created_at', 'asc')
            ->paginate(10); // tampilkan 10 data per halaman

        return view('kendaraan.tindak-kerusakan-kendaraan', [
            'kerusakanKendaraan' => $kerusakanList,
        ]);
    }




    public function halamanBuktiPerbaikanKerusakanKendaraan($hash)
    {
        try {
            // 🔐 Dekripsi hash untuk mendapatkan ID asli
            $id = Crypt::decryptString($hash);
        } catch (DecryptException $e) {
            // Jika hash rusak / tidak cocok, munculkan 404
            abort(404, 'Invalid link');
        }

        // 🔍 Ambil data kerusakan kendaraan berdasarkan ID
        $kerusakan = KerusakanKendaraan::with(['kendaraan', 'user'])->findOrFail($id);
        $buktiPerbaikan = \App\Models\PerbaikanKerusakanKendaraan::with('userInspektor')
            ->where('id_kerusakan_kendaraan', $id)
            ->latest()
            ->get();

        // Kirim data ke view
        return view('kendaraan.tindak-perbaikan-kerusakan-kendaraan', [
            'kerusakan' => $kerusakan,
            'buktiPerbaikan' => $buktiPerbaikan,

        ]);
    }

    public function simpanBuktiPerbaikanKerusakanKendaraan(Request $request)
    {
        // Validasi input
        $validated = $request->validate([
            'catatan_perbaikan' => 'required|string',
            'file_bukti_perbaikan' => 'required|file|mimes:jpeg,png,jpg,gif,webp,pdf|max:10240',
            'id_kerusakan_kendaraan' => 'required|exists:kerusakan_kendaraan,id',
        ]);

        // Tambahkan id_user_inspektor dari user yang login
        $validated['id_user_inspektor'] = Auth::id();

        // Handle upload file
        if ($request->hasFile('file_bukti_perbaikan')) {
            $file = $request->file('file_bukti_perbaikan');
            $namaFile = time() . '_' . $file->getClientOriginalName();

            // Simpan file - gunanakan store() dengan path yang benar
            $path = $file->store('perbaikan_kerusakan_kendaraan', 'public');

            // Simpan path untuk database
            $validated['file_bukti_perbaikan'] = $path;
        }

        // Simpan data ke database
        PerbaikanKerusakanKendaraan::create([
            'id_kerusakan_kendaraan' => $validated['id_kerusakan_kendaraan'],
            'id_user_inspektor' => $validated['id_user_inspektor'],
            'catatan_perbaikan' => $validated['catatan_perbaikan'],
            'file_bukti_perbaikan' => $validated['file_bukti_perbaikan'],
        ]);

        return redirect()->back()->with('success', 'Bukti perbaikan kerusakan kendaraan berhasil disimpan.');
    }
}
