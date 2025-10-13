<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kendaraan extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'kendaraan';

    protected $fillable = [
        'tipe_kendaraan',
        'plat_kendaraan',
        'pajak_berlaku_hingga',
        'km',
        'waktu_diservice_terakhir',
        'waktu_diservice_selanjutnya'
    ];

    public function pajakKendaraan()
    {
        return $this->hasMany(PajakKendaraan::class, 'id_kendaraan');
    }
    public function historiServiceKendaraan()
    {
        return $this->hasMany(HistoriServiceKendaraan::class, 'id_kendaraan');
    }


    /**
     * Accessor untuk format tanggal service terakhir
     */
    public function getWaktuDiserviceTerakhirAttribute($value)
    {
        return $value ? \Carbon\Carbon::parse($value)->format('Y-m-d') : null;
    }

    /**
     * Accessor untuk format tanggal service selanjutnya
     */
    public function getWaktuDiserviceSelanjutnyaAttribute($value)
    {
        return $value ? \Carbon\Carbon::parse($value)->format('Y-m-d') : null;
    }
}
