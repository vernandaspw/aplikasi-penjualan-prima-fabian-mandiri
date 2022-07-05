<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KasirKas extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function jenis()
    {
        return $this->belongsTo(KasirKasJenis::class, 'kasir_kas_jenis_id', 'id');
    }
    
    public function kategori()
    {
        return $this->belongsTo(KasirKasKategori::class, 'kasir_kas_kategori_id', 'id');
    }
}
