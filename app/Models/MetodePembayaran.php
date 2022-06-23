<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MetodePembayaran extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function metode_kirim()
    {
        return $this->belongsToMany(MetodeKirim::class, MetodeKirimPembayaran::class);
    }
}
