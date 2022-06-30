<?php

namespace App\Http\Livewire\Konsumen;

use Livewire\Component;

class UbahPasswordKonsumen extends Component
{
    public function render()
    {
        return view('livewire.konsumen.ubah-password-konsumen')->extends('layouts.main')->section('content');
    }
}
