<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BuktiPerbaikan extends Model
{
    protected $table = 'bukti_perbaikan';
    protected $primaryKey = 'id';
    public $timestamps = true;
    protected $fillable = [
        'catatan_bukti_perbaikan',
        'file_bukti_perbaikan',
        'id_bukti_kerusakan',
        'id_user_inspektor',
    ];
    public function buktiKerusakan()
    {
        return $this->belongsTo(BuktiKerusakan::class, 'id_bukti_kerusakan');
    }  
    public function userInspektor()
    {
        return $this->belongsTo(User::class, 'id_user_inspektor');
    }
}
