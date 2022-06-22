<?php

namespace App\Http\Livewire\Konsumen;

use Livewire\Component;

class PerusahaanKonsumen extends Component
{
    public function render()
    {
        redirect('login');
        return view('livewire.konsumen.perusahaan-konsumen')->extends('layouts.main')->section('content');
    }
}
