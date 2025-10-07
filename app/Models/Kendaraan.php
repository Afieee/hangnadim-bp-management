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
    ];
}
