<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PenjadwalanTamu extends Model
{
    protected $table = 'penjadwalan_tamu';
    protected $primaryKey = 'id';

    protected $fillable = [
        'level_tamu',
        'subjek_tamu',
        'instansi',
        'waktu_penggunaan_gedung',
        'waktu_selesai_penggunaan_gedung',
        'kode_penerbangan',
        'kode_bandara_asal',
        'lembar_disposisi',
        'narahubung_pihak_tamu',
        'no_handphone_narahubung',
        'email_narahubung',
        'id_gedung',
        'id_user',
    ];

    public function gedung()
    {
        return $this->belongsTo(Gedung::class, 'id_gedung');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
    public function feedbacks()
    {
        return $this->hasMany(\App\Models\Feedback::class, 'id_penjadwalan_tamu');
    }
}
