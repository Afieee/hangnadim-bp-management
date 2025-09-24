<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;
use App\Models\PenjadwalanTamu;
use Illuminate\Support\Facades\Crypt;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'catatan_feedback' => 'nullable|string',
            'perwakilan_atau_pengisi' => 'required|string|max:255',
            'indeks_rating_pelayanan' => 'required|numeric|between:0,100',
            'id_penjadwalan_tamu' => 'required|integer',
        ]);

        // Cek apakah sudah ada feedback untuk penjadwalan ini
        $existingFeedback = Feedback::where('id_penjadwalan_tamu', $request->id_penjadwalan_tamu)->first();
        if ($existingFeedback) {
            return redirect()->route('feedback.thankyou')->with('error', 'Feedback sudah pernah dikirim sebelumnya.');
        }

        // Hitung mutu dan predikat
        $indeks = floatval($request->indeks_rating_pelayanan);
        if ($indeks >= 88.31 && $indeks <= 100) {
            $mutu = 'A';
            $predikat = 'Sangat Baik';
        } elseif ($indeks >= 76.61 && $indeks <= 88.30) {
            $mutu = 'B';
            $predikat = 'Baik';
        } elseif ($indeks >= 65.00 && $indeks <= 76.60) {
            $mutu = 'C';
            $predikat = 'Kurang Baik';
        } else {
            $mutu = 'D';
            $predikat = 'Tidak Baik';
        }

        // Ambil previous hash terakhir
        $previousFeedback = Feedback::latest()->first();
        $previous_hash = $previousFeedback ? $previousFeedback->hash : null;

        // Simpan ke tabel feedback
        $feedback = new Feedback();
        $feedback->id_penjadwalan_tamu = $request->id_penjadwalan_tamu;
        $feedback->perwakilan_atau_pengisi = $request->perwakilan_atau_pengisi;
        $feedback->catatan_feedback = $request->catatan_feedback;
        $feedback->indeks_rating_pelayanan = $indeks;
        $feedback->mutu_rating_pelayanan = $mutu;
        $feedback->predikat_rating_pelayanan = $predikat;
        $feedback->previous_hash = $previous_hash;

        // Hitung hash termasuk perwakilan_atau_pengisi
        $feedback->hash = hash(
            'sha256',
            $feedback->id_penjadwalan_tamu .
                $feedback->catatan_feedback .
                $feedback->perwakilan_atau_pengisi .
                $feedback->indeks_rating_pelayanan .
                $feedback->mutu_rating_pelayanan .
                $feedback->predikat_rating_pelayanan .
                $previous_hash .
                now()
        );

        $feedback->save();

        // Simpan juga ke tabel backup_feedback
        \App\Models\BackupFeedback::create([
            'id_feedback' => $feedback->id,
            'perwakilan_atau_pengisi' => $feedback->perwakilan_atau_pengisi,
            'catatan_feedback' => $feedback->catatan_feedback,
            'indeks_rating_pelayanan' => $feedback->indeks_rating_pelayanan,
            'mutu_rating_pelayanan' => $feedback->mutu_rating_pelayanan,
            'predikat_rating_pelayanan' => $feedback->predikat_rating_pelayanan,
        ]);


        return redirect()->route('feedback.thankyou')->with('success', 'Feedback berhasil dikirim!');
    }





    public function halamanTerimakasih()
    {
        return view('pages.terimakasih');
    }



    public function halamanDataFeedback()
    {
        // Gunakan paginate
        $feedback = Feedback::with('penjadwalanTamu')->paginate(4);

        // Selalu array karena verifyChain sudah dikoreksi
        $invalidIds = Feedback::verifyChain();
        $errorMessage = null;

        if (!empty($invalidIds)) {
            $idList = implode(', ', $invalidIds);
            $errorMessage = "⚠️ Data feedback dengan ID <strong>{$idList}</strong> terdeteksi telah diubah! Tolong untuk admin database agar segera menangani";
        }

        return view('pages.halaman-data-feedback', [
            'feedback' => $feedback,
            'errorMessage' => $errorMessage,
        ]);
    }
}
