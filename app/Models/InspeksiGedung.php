<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class InspeksiGedung extends Model
{
    protected $table = 'inspeksi_gedung';
    protected $primaryKey = 'id';

    protected $fillable = [
        'furniture',
        'fire_system',
        'gedung_dan_bangunan',
        'mekanikal_elektrikal',
        'it',
        'jalan_dan_jembatan',
        'jaringan_air',
        'drainase',
        'id_gedung',
        'id_user',
        'status_keseluruhan_inspeksi',
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
