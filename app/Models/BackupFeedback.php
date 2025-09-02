<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BackupFeedback extends Model
{
    protected $table = 'backup_feedback';
    protected $primaryKey = 'id';

    protected $fillable = [
        'catatan_feedback',
        'perwakilan_atau_pengisi',
        'indeks_rating_pelayanan',
        'mutu_rating_pelayanan',
        'predikat_rating_pelayanan',
        'id_feedback',
    ];


    public function feedback()
    {
        return $this->belongsTo(Feedback::class, 'id_feedback');
    }
}
