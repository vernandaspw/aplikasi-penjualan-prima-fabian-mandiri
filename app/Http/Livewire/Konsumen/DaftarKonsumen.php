<?php

namespace App\Http\Livewire\Konsumen;

use Livewire\Component;

class DaftarKonsumen extends Component
{
    public function render()
    {
        return view('livewire.konsumen.daftar-konsumen')->extends('layouts.main')->section('content');
    }
}
