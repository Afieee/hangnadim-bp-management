<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuktiKerusakan extends Model
{
    protected $table = 'bukti_kerusakan';
    protected $primaryKey = 'id';
    public $timestamps = true;

    protected $fillable = [
        'judul_bukti_kerusakan',
        'deskripsi_bukti_kerusakan',
        'lokasi_bukti_kerusakan',
        'tipe_kerusakan',
        'file_bukti_kerusakan',
        'id_inspeksi_gedung',
        'id_user_inspektor',
    ];

    public function inspeksiGedung()
    {
        return $this->belongsTo(InspeksiGedung::class, 'id_inspeksi_gedung');
    }

    public function userInspektor()
    {
        return $this->belongsTo(User::class, 'id_user_inspektor');
    }

    public function buktiPerbaikan()
{
    return $this->hasOne(BuktiPerbaikan::class, 'id_bukti_kerusakan');
}

    
}
