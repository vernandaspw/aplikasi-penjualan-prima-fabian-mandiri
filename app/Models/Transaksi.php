<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function transaksiitem()
    {
        return $this->hasMany(TransaksiItem::class, 'transaksi_id', 'id');
    }

    public function metodekirim()
    {
        return $this->belongsTo(MetodeKirim::class, 'metode_kirim_id', 'id');
    }

    public function konsumen()
    {
        return $this->belongsTo(Konsumen::class, 'konsumen_id', 'id');
    }

    public function metodepembayaran()
    {
        return $this->belongsTo(MetodePembayaran::class, 'metode_pembayaran_id', 'id');
    }

    public function transaksilog()
    {
        return $this->hasMany(transaksilog::class, 'transaksi_id', 'id');
    }
}
