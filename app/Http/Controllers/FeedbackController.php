<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        // Validasi input
        $request->validate([
            'catatan_feedback' => 'nullable|string',
            'indeks_rating_pelayanan' => 'required|numeric|between:0,100',
            'id_penjadwalan_tamu' => 'required|integer',
        ]);

        // Hitung mutu dan predikat berdasarkan indeks
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
        } else { // 25.00 - 64.99
            $mutu = 'D';
            $predikat = 'Tidak Baik';
        }

        // Ambil previous hash terakhir
        $previousFeedback = Feedback::latest()->first();
        $previous_hash = $previousFeedback ? $previousFeedback->hash : null;

        // Simpan data ke database
        $feedback = new Feedback();
        $feedback->id_penjadwalan_tamu = $request->id_penjadwalan_tamu;
        $feedback->catatan_feedback = $request->catatan_feedback;
        $feedback->indeks_rating_pelayanan = $indeks;
        $feedback->mutu_rating_pelayanan = $mutu;
        $feedback->predikat_rating_pelayanan = $predikat;
        $feedback->previous_hash = $previous_hash;

        // Hitung hash
        $feedback->hash = hash('sha256',
            $feedback->id_penjadwalan_tamu .
            $feedback->catatan_feedback .
            $feedback->indeks_rating_pelayanan .
            $feedback->mutu_rating_pelayanan .
            $feedback->predikat_rating_pelayanan .
            $previous_hash .
            now()
        );

        $feedback->save();

    return redirect()->route('tampil.manage.kedatangan')->with('success', 'Feedback berhasil dikirim!');
    }



}
