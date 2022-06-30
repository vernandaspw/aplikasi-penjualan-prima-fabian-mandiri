<?php

namespace App\Http\Livewire\Konsumen;

use Livewire\Component;

class UbahAlamatKonsumen extends Component
{
    public function render()
    {
        return view('livewire.konsumen.ubah-alamat-konsumen')->extends('layouts.main')->section('content');
    }
}
