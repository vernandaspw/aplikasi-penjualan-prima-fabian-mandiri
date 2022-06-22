<?php

namespace App\Http\Livewire\Konsumen;

use App\Models\Pengaturan;
use App\Models\ProdukKategori;
use App\Models\ProdukMerek;
use Livewire\Component;

class BerandaKonsumen extends Component
{
    public $perusahaan, $produkkategori, $produkmerek;

    public function mount()
    {
        $this->perusahaan = Pengaturan::first();
        $this->produkkategori = ProdukKategori::latest()->get();
        $this->produkmerek = ProdukMerek::latest()->get();
  
    }

    public function render()
    {
        return view('livewire.konsumen.beranda-konsumen')->extends('layouts.main')->section('content');
    }
}
