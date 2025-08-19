<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Gedung extends Model
{
    protected $table = 'gedung';
    protected $primaryKey = 'id';

    protected $fillable = [
        'nama_gedung',
        'foto_gedung',
    ];

    public function inspeksi()
    {
        return $this->hasMany(InspeksiGedung::class, 'id_gedung');
    }
}
