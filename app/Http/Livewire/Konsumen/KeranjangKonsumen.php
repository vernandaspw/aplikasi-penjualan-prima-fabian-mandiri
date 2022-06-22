<?php

namespace App\Http\Livewire\Konsumen;

use Livewire\Component;

class KeranjangKonsumen extends Component
{
    public $qty = 1;

    public function render()
    {
        return view('livewire.konsumen.keranjang-konsumen')->extends('layouts.main')->section('content');
    }
}
