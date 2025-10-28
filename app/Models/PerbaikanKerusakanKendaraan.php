<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PerbaikanKerusakanKendaraan extends Model
{
    protected $table = 'perbaikan_kerusakan_kendaraan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'catatan_perbaikan',
        'file_bukti_perbaikan',
        'id_kerusakan_kendaraan',
        'id_user_inspektor',
    ];
    public function kerusakanKendaraan()
    {
        return $this->belongsTo(KerusakanKendaraan::class, 'id_kerusakan_kendaraan');
    }
    public function userInspektor()
    {
        return $this->belongsTo(User::class, 'id_user_inspektor');
    }
}
