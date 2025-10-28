<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $table = 'users';
    protected $primaryKey = 'id';
    protected $fillable = [
        'nip_atau_nup',
        'name',
        'email',
        'password',
        'role',
    ];


    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];


    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function inspeksiGedung()
    {
        return $this->hasMany(InspeksiGedung::class, 'id_user');
    }
    public function penjadwalanTamu()
    {
        return $this->hasMany(PenjadwalanTamu::class, 'id_user');
    }
    public function buktiKerusakan()
    {
        return $this->hasMany(BuktiKerusakan::class, 'id_user');
    }
    public function buktiPerbaikan()
    {
        return $this->hasMany(BuktiPerbaikan::class, 'id_user');
    }
    public function gedung()
    {
        return $this->hasMany(Gedung::class, 'id_user');
    }
    public function pajakKendaraan()
    {
        return $this->hasMany(PajakKendaraan::class, 'id_user');
    }
    public function historiServiceKendaraan()
    {
        return $this->hasMany(HistoriServiceKendaraan::class, 'id_user');
    }

    public function kerusakanKendaraan()
    {
        return $this->hasMany(KerusakanKendaraan::class, 'id_user');
    }
    public function perbaikanKerusakanKendaraan()
    {
        return $this->hasMany(PerbaikanKerusakanKendaraan::class, 'id_user_inspektor');
    }
}
