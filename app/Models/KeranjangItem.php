<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KeranjangItem extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function keranjang()
    {
        return $this->belongsTo(Keranjang::class, 'keranjang_id', 'id');
    }

    public function konsumen()
    {
        return $this->hasOne(Konsumen::class, 'konsumen_id', 'id');
    }
    public function pegawai()
    {
        return $this->hasOne(Pegawai::class, 'pegawai_id', 'id');
    }
    public function produk()
    {
        return $this->belongsTo(Produk::class, 'produk_id', 'id');
    }
}
