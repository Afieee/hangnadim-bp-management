<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kendaraan;
use Illuminate\Http\Request;
use App\Models\PajakKendaraan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;
use App\Models\HistoriServiceKendaraan;

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

        // Statistik service
        $totalKendaraanPerluService = 0;
        $totalKendaraanAkanService = 0;
        $totalKendaraanServiceBaik = 0;
        $totalKendaraanBelumDiatur = 0;

        foreach ($kendaraan as $item) {
            // Hitung statistik pajak
            if (!$item->pajak_berlaku_hingga) {
                // Jika pajak belum diisi, hitung sebagai pajak mati
                $totalKendaraanPajakMati++;
            } else {
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

            // Hitung statistik service
            if (!$item->waktu_diservice_selanjutnya) {
                $totalKendaraanBelumDiatur++;
            } else {
                $serviceDate = Carbon::parse($item->waktu_diservice_selanjutnya);
                $diffDays = $today->diffInDays($serviceDate, false);

                if ($diffDays < 0) {
                    // Sudah lewat batas - Perlu Service
                    $totalKendaraanPerluService++;
                } elseif ($diffDays <= 7) {
                    // Kurang dari 7 hari - Akan Service
                    $totalKendaraanAkanService++;
                } else {
                    // Masih lama - Kondisi Baik
                    $totalKendaraanServiceBaik++;
                }
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
                'totalKendaraanPerluService' => $totalKendaraanPerluService,
                'totalKendaraanAkanService' => $totalKendaraanAkanService,
                'totalKendaraanServiceBaik' => $totalKendaraanServiceBaik,
                'totalKendaraanBelumDiatur' => $totalKendaraanBelumDiatur,
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

    public function updatePajak(Request $request, $id)
    {
        $request->validate([
            'pajak_berlaku_hingga' => 'required|date'
        ]);

        // Ambil data kendaraan
        $kendaraan = Kendaraan::findOrFail($id);

        // Update kolom pajak_berlaku_hingga
        $kendaraan->update([
            'pajak_berlaku_hingga' => $request->pajak_berlaku_hingga
        ]);

        // Simpan ke tabel PajakKendaraan sebagai histori
        PajakKendaraan::create([
            'catatan_pencatatan_pajak' => $request->pajak_berlaku_hingga,
            'id_kendaraan' => $id,
            'id_user' => Auth::id(), // ambil id user yang sedang login
        ]);

        return redirect()->route('kendaraan.halaman')
            ->with('success', 'Tanggal pajak berhasil diperbarui dan riwayat pajak telah disimpan.');
    }

    public function halamanHistoriPajakKendaraan($encryptedId)
    {
        try {
            // Dekripsi id yang terenkripsi dari URL
            $id = Crypt::decryptString($encryptedId);
        } catch (\Exception $e) {
            abort(404, 'Invalid or corrupted vehicle identifier.');
        }

        // Ambil data kendaraan
        $kendaraan = Kendaraan::findOrFail($id);
        $detailPlatKendaraan = Kendaraan::where('id', $id)
            ->distinct()
            ->value('plat_kendaraan');

        $detailTipeKendaraan = Kendaraan::where('id', $id)
            ->distinct()
            ->value('tipe_kendaraan');

        // Ambil histori pajak kendaraan terkait
        $historiPajak = PajakKendaraan::where('id_kendaraan', $id)
            ->with(['user', 'kendaraan'])
            ->orderBy('created_at', 'desc')
            ->get();

        return view('kendaraan.histori-pajak-kendaraan', [
            'kendaraan' => $kendaraan,
            'historiPajak' => $historiPajak,
            'detailPlatKendaraan' => $detailPlatKendaraan,
            'detailTipeKendaraan' => $detailTipeKendaraan,
        ]);
    }

    // Method untuk mengambil data kendaraan berdasarkan ID
    public function getKendaraan($id)
    {
        $kendaraan = Kendaraan::findOrFail($id);
        return response()->json($kendaraan);
    }

    public function updateStatusService(Request $request, $id)
    {
        try {
            // Coba decrypt ID jika terenkripsi
            try {
                $id = Crypt::decryptString($id);
            } catch (\Exception $e) {
                // Jika gagal decrypt, gunakan ID apa adanya
            }

            // Validasi input
            $request->validate([
                'km' => 'required|numeric|min:0',
                'waktu_diservice_terakhir' => 'required|date',
                'waktu_diservice_selanjutnya' => 'required|date|after:waktu_diservice_terakhir',
            ]);

            // Ambil data kendaraan
            $kendaraan = Kendaraan::findOrFail($id);

            // Update data kendaraan utama
            $kendaraan->update([
                'km' => $request->km,
                'waktu_diservice_terakhir' => $request->waktu_diservice_terakhir,
                'waktu_diservice_selanjutnya' => $request->waktu_diservice_selanjutnya,
            ]);

            // Simpan ke tabel histori_service_kendaraan
            HistoriServiceKendaraan::create([
                'id_kendaraan' => $kendaraan->id,
                'km' => $request->km,
                'waktu_diservice_terakhir' => $request->waktu_diservice_terakhir,
                'waktu_diservice_selanjutnya' => $request->waktu_diservice_selanjutnya,
                'id_user' => Auth::id(), // user login aktif
            ]);

            return redirect()->route('kendaraan.halaman')
                ->with('success', 'Status servis kendaraan berhasil diperbarui dan dicatat ke histori!');
        } catch (\Exception $e) {
            return redirect()->route('kendaraan.halaman')
                ->with('error', 'Gagal memperbarui status servis: ' . $e->getMessage());
        }
    }

    public function halamanHistoriServiceKendaraan($encryptedId)
    {
        try {
            // Dekripsi id yang terenkripsi dari URL
            $id = Crypt::decryptString($encryptedId);
        } catch (\Exception $e) {
            abort(404, 'Invalid or corrupted vehicle identifier.');
        }

        // Ambil data kendaraan
        $kendaraan = Kendaraan::findOrFail($id);
        $detailPlatKendaraan = Kendaraan::where('id', $id)
            ->distinct()
            ->value('plat_kendaraan');
        $detailTipeKendaraan = Kendaraan::where('id', $id)
            ->distinct()
            ->value('tipe_kendaraan');
        // Ambil histori service kendaraan terkait
        $historiService = HistoriServiceKendaraan::where('id_kendaraan', $id)
            ->with(['user', 'kendaraan'])
            ->orderBy('created_at', 'desc')
            ->get();
        return view('kendaraan.histori-service-kendaraan', [
            'kendaraan' => $kendaraan,
            'historiService' => $historiService,
            'detailPlatKendaraan' => $detailPlatKendaraan,
            'detailTipeKendaraan' => $detailTipeKendaraan,
        ]);
    }
}
