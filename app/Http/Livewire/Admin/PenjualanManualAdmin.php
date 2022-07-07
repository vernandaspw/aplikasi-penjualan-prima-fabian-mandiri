<?php

namespace App\Http\Livewire\Admin;

use App\Models\Produk;
use App\Models\ProdukKategori;
use Livewire\Component;

class PenjualanManualAdmin extends Component
{
    public $kategori = [];

    public $take;
    public $produk = [];
    public $cariproduk, $kategori_id;

    public function lanjut()
    {
        $this->take = $this->take + 10;
    }
    public function render()
    {
        $this->kategori = ProdukKategori::latest()->get();

        $produk = Produk::with('kategori', 'gambar', 'produkstok')->where('istersedia', true);
        if ($this->kategori_id) {
            $produk->where('produk_kategori_id', $this->kategori_id);
        }
        if ($this->cariproduk) {
            $produk->where('nama', 'like', '%' . $this->cariproduk . '%')->orWhere('barcode', 'like', '%' . $this->cariproduk . '%');
        }
        $this->produk = $produk->take($this->take)->latest()->get();
        return view('livewire.admin.penjualan-manual-admin')->extends('layouts.main')->section('content');
    }
}
