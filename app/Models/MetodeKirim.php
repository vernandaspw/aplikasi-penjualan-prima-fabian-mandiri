<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodeKirim extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function metode_pembayaran()
    {
        return $this->belongsToMany(MetodePembayaran::class, MetodeKirimPembayaran::class);
    }
}
