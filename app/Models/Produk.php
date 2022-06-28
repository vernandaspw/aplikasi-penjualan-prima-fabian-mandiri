<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produk extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function kategori()
    {
        return $this->belongsTo(ProdukKategori::class, 'produk_kategori_id', 'id');
    }
    public function merek()
    {
        return $this->belongsTo(ProdukMerek::class, 'produk_merek_id', 'id');
    }
    public function gambar()
    {
        return $this->hasMany(ProdukGaleri::class, 'produk_id', 'id');
    }

    public function transaksiitem()
    {
        return $this->hasMany(TransaksiItem::class, 'produk_id', 'id');
    }
    public function produkulasan()
    {
        return $this->hasMany(ProdukUlasan::class, 'produk_id', 'id');
    }
    public function produkstok()
    {
        return $this->hasOne(ProdukStok::class, 'produk_id', 'id');
    }
}
