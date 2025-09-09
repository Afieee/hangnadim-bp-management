<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    use HasFactory;

    protected $table = 'feedback';
    protected $primaryKey = 'id';

    protected $fillable = [
        'catatan_feedback',
        'perwakilan_atau_pengisi',
        'indeks_rating_pelayanan',
        'mutu_rating_pelayanan',
        'predikat_rating_pelayanan',
        'id_penjadwalan_tamu',
        'hash',
        'previous_hash',
    ];

    /**
     * Relasi ke PenjadwalanTamu
     */
    public function penjadwalanTamu()
    {
        return $this->belongsTo(PenjadwalanTamu::class, 'id_penjadwalan_tamu');
    }

        public function backupFeedbacks()
    {
        return $this->hasMany(BackupFeedback::class, 'id_feedback');
    }

    /**
     * Fungsi verifikasi hash chain
     */
public static function verifyChain()
{
    $feedbacks = self::orderBy('id')->get();
    $invalidIds = [];

    foreach ($feedbacks as $feedback) {
        $calculated_hash = hash(
            'sha256',
            $feedback->id_penjadwalan_tamu .
            $feedback->catatan_feedback .
            $feedback->perwakilan_atau_pengisi .
            $feedback->indeks_rating_pelayanan .
            $feedback->mutu_rating_pelayanan .
            $feedback->predikat_rating_pelayanan .
            $feedback->previous_hash .
            $feedback->created_at
        );

        if ($feedback->hash !== $calculated_hash) {
            $invalidIds[] = $feedback->id; // simpan ID yang salah
        }
    }

    // Selalu return array (bisa kosong)
    return $invalidIds;
}


}
