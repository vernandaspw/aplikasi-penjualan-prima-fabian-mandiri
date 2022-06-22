<?php

namespace App\Http\Livewire\Konsumen;

use App\Models\Pengaturan;
use Livewire\Component;

class BerandaKonsumen extends Component
{
    public $perusahaan;

    public function mount()
    {
        $this->perusahaan = Pengaturan::first();
    }

    public function render()
    {
        return view('livewire.konsumen.beranda-konsumen')->extends('layouts.main')->section('content');
    }
}
