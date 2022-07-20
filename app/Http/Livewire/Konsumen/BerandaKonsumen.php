<?php

namespace App\Http\Livewire\Konsumen;

use App\Models\Pengaturan;
use App\Models\Produk;
use App\Models\ProdukKategori;
use App\Models\ProdukMerek;
use Livewire\Component;

class BerandaKonsumen extends Component
{
    public $perusahaan;
    public $produkkategori, $produkmerek, $produk = [];
    public $jml_terjual;

    public $take = 8;
    public $jmlproduk;

    public function lanjut()
    {
        $this->take = $this->take + 8;
    }

    public function cariproduk()
    {
        redirect('produk');
    }

    public function mount()
    {
        $this->perusahaan = Pengaturan::first();
        $this->produkkategori = ProdukKategori::latest()->get();
        $this->produkmerek = ProdukMerek::latest()->get();
    }

    public function render()
    {
        $this->produk = Produk::with('transaksiitem', 'produkulasan')->where('istersedia', true)->latest()->take($this->take)->get();

        $this->jmlproduk = Produk::where('istersedia', true)->get()->count();
        return view('livewire.konsumen.beranda-konsumen')->extends('layouts.main')->section('content');
    }
}
