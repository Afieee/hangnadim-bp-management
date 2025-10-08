<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PajakKendaraan extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'pajak_kendaraan';
    protected $fillable = [
        'catatan_pencatatan_pajak',
        'id_kendaraan',
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
