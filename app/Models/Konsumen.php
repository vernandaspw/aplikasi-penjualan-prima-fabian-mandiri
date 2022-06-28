<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Konsumen extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $guard = 'konsumen';

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nama',
        'jeniskelamin',
        'nohp',
        'email',
        'password',
        'avatar',
        'provinsi',
        'kota',
        'kecamatan',
        'alamat',
        'patokan',
        'kodepos',
        'lat',
        'long',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function keranjang()
    {
        return $this->hasOne(Keranjang::class, 'konsumen_id', 'id');
    }

    public function keranjangitem()
    {
        return $this->hasMany(keranjangitem::class, 'konsumen_id', 'id');
    }
}
