<?php

namespace App\Http\Livewire\Konsumen;

use Livewire\Component;

class BerandaKonsumen extends Component
{
    public function render()
    {
        return view('livewire.konsumen.beranda-konsumen')->extends('layouts.main')->section('content');
    }
}
