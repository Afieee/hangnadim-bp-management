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
        'waktu_tamu_berangkat',
        'waktu_tamu_mendarat',
        'kode_penerbangan',
        'kode_bandara_asal',
        'lembar_disposisi',
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
}
