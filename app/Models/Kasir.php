<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kasir extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function kasirkas()
    {
        return $this->hasMany(KasirKas::class, 'kasir_id', 'id');
    }
}
