<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistoriServiceKendaraan extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'histori_service_kendaraan';
    protected $fillable = [
        'id_kendaraan',
        'km',
        'waktu_diservice_terakhir',
        'waktu_diservice_selanjutnya',
        'id_user',
    ];

    public function kendaraan()
    {
        return $this->belongsTo(Kendaraan::class, 'id_kendaraan');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
