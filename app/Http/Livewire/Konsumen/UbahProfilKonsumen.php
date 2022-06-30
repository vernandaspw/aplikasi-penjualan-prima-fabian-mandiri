<?php

namespace App\Http\Livewire\Konsumen;

use Livewire\Component;

class UbahProfilKonsumen extends Component
{
    public function render()
    {
        return view('livewire.konsumen.ubah-profil-konsumen')->extends('layouts.main')->section('content');
    }
}
