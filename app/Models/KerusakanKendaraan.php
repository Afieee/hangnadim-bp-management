<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class KerusakanKendaraan extends Model
{
    protected $table = 'kerusakan_kendaraan';
    protected $primaryKey = 'id';
    protected $fillable = [
        'objek_kerusakan',
        'tipe_kerusakan',
        'deskripsi_kerusakan',
        'foto_kerusakan',
        'status_kerusakan',
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
    public function perbaikanKerusakanKendaraan()
    {
        return $this->hasMany(PerbaikanKerusakanKendaraan::class, 'id_kerusakan_kendaraan');
    }
}
