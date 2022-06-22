<?php

namespace App\Http\Livewire\Konsumen;

use App\Models\Pengaturan;
use Livewire\Component;

class PerusahaanKonsumen extends Component
{
    public $perusahaan;

    public function mount()
    {
        $this->perusahaan = Pengaturan::first();
    }
    public function render()
    {
        return view('livewire.konsumen.perusahaan-konsumen')->extends('layouts.main')->section('content');
    }
}
