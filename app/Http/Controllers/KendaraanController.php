<?php

namespace App\Http\Controllers;

use App\Models\Kendaraan;
use Illuminate\Http\Request;
use Carbon\Carbon;

class KendaraanController extends Controller
{
    public function halamanKendaraan()
    {
        $kendaraan = Kendaraan::all();

        // Hitung statistik di controller
        $today = now();
        $totalKendaraan = $kendaraan->count();
        $totalKendaraanAkanMatiPajak = 0;
        $totalKendaraanPajakMati = 0;
        $totalKendaraanPajakHidup = 0;

        foreach ($kendaraan as $item) {
            if (!$item->pajak_berlaku_hingga) {
                // Jika pajak belum diisi, hitung sebagai pajak mati
                $totalKendaraanPajakMati++;
                continue;
            }

            $pajakDate = Carbon::parse($item->pajak_berlaku_hingga);

            if ($pajakDate->lt($today)) {
                // Pajak sudah mati
                $totalKendaraanPajakMati++;
            } elseif ($pajakDate->gt($today) && $today->diffInDays($pajakDate) <= 30) {
                // Pajak akan mati dalam 30 hari ke depan
                $totalKendaraanAkanMatiPajak++;
            } else {
                // Pajak masih hidup (lebih dari 30 hari ke depan)
                $totalKendaraanPajakHidup++;
            }
        }

        // Tambahkan status dan sisa waktu ke setiap kendaraan
        $kendaraan->transform(function ($item) use ($today) {
            if (!$item->pajak_berlaku_hingga) {
                $item->status = 'expired';
                $item->status_text = 'Belum Ada Data Pajak';
                $item->badge_class = 'badge-expired';
                $item->sisa_waktu = 'Data Kosong';
                $item->sisa_waktu_badge_class = 'badge-expired';
                return $item;
            }

            $pajakDate = Carbon::parse($item->pajak_berlaku_hingga);
            $interval = $today->diff($pajakDate);

            $years = $interval->y;
            $months = $interval->m;
            $days = $interval->d;

            // Tentukan status
            if ($pajakDate->lt($today)) {
                $item->status = 'expired';
                $item->status_text = 'Sudah Harus Bayar Pajak Kendaraan';
                $item->badge_class = 'badge-expired';
                $item->sisa_waktu = 'Pajak Mati';
                $item->sisa_waktu_badge_class = 'badge-expired';
            } elseif ($years == 0 && $months == 0 && $days <= 30) {
                $item->status = 'warning';
                $item->status_text = 'Mendekati Perpanjangan Pajak Kendaraan';
                $item->badge_class = 'badge-warning';
                $item->sisa_waktu = $this->formatSisaWaktu($years, $months, $days);
                $item->sisa_waktu_badge_class = '';
            } else {
                $item->status = 'valid';
                $item->status_text = 'Pajak Kendaraan Masih Berlaku';
                $item->badge_class = 'badge-success';
                $item->sisa_waktu = $this->formatSisaWaktu($years, $months, $days);
                $item->sisa_waktu_badge_class = '';
            }

            return $item;
        });

        return view('kendaraan.list-kendaraan', [
            'kendaraan' => $kendaraan,
            'stats' => [
                'totalKendaraan' => $totalKendaraan,
                'totalKendaraanAkanMatiPajak' => $totalKendaraanAkanMatiPajak,
                'totalKendaraanPajakMati' => $totalKendaraanPajakMati,
                'totalKendaraanPajakHidup' => $totalKendaraanPajakHidup,
            ]
        ]);
    }

    // Helper method untuk format sisa waktu
    private function formatSisaWaktu($years, $months, $days)
    {
        $result = '';

        if ($years > 0) {
            $result .= $years . ' tahun ';
        }
        if ($months > 0) {
            $result .= $months . ' bulan ';
        }
        if ($days > 0) {
            $result .= $days . ' hari';
        }

        if ($years == 0 && $months == 0 && $days == 0) {
            $result = 'Hari ini terakhir';
        }

        return trim($result);
    }

    // 1. Proses Tambah Kendaraan
    public function store(Request $request)
    {
        $request->validate([
            'tipe_kendaraan' => 'required|in:mobil,motor,bus',
            'plat_kendaraan' => 'required|string|max:15|unique:kendaraan,plat_kendaraan',
            'pajak_berlaku_hingga' => 'nullable|date'
        ]);

        Kendaraan::create($request->all());

        return redirect()->route('kendaraan.halaman')
            ->with('success', 'Kendaraan berhasil ditambahkan');
    }

    // 2. Proses Update Data Kendaraan (kecuali pajak)
    public function update(Request $request, $id)
    {
        $request->validate([
            'tipe_kendaraan' => 'required|in:mobil,motor,bus',
            'plat_kendaraan' => 'required|string|max:15|unique:kendaraan,plat_kendaraan,' . $id
        ]);

        $kendaraan = Kendaraan::findOrFail($id);
        $kendaraan->update([
            'tipe_kendaraan' => $request->tipe_kendaraan,
            'plat_kendaraan' => $request->plat_kendaraan
        ]);

        return redirect()->route('kendaraan.halaman')
            ->with('success', 'Data kendaraan berhasil diperbarui');
    }

    // 3. Proses Update Pajak Khusus
    public function updatePajak(Request $request, $id)
    {
        $request->validate([
            'pajak_berlaku_hingga' => 'required|date'
        ]);

        $kendaraan = Kendaraan::findOrFail($id);
        $kendaraan->update([
            'pajak_berlaku_hingga' => $request->pajak_berlaku_hingga
        ]);

        return redirect()->route('kendaraan.halaman')
            ->with('success', 'Tanggal pajak berhasil diperbarui');
    }

    // Method untuk mengambil data kendaraan berdasarkan ID
    public function getKendaraan($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        return response()->json($kendaraan);
    }
}
