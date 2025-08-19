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
        'bangunan',
        'mekanikal_elektrikal',
        'it',
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
