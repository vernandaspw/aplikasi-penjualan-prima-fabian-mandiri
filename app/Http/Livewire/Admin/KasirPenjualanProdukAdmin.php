<?php

namespace App\Http\Livewire\Admin;

use App\Models\Kasir;
use App\Models\Produk;
use App\Models\ProdukKategori;
use Livewire\Component;

class KasirPenjualanProdukAdmin extends Component
{

    public $id_kasir;
    public $kasir;

    public $kategori = [];

    public $take;
    public $produk = [];
    public $cariproduk, $kategori_id;
  

    public function lanjut()
    {
        $this->take = $this->take + 10;
    }

    public function mount($id)
    {
        $this->id_kasir = $id;
    }

    public function render()
    {
        $this->kasir = Kasir::find($this->id_kasir);
        $this->kategori = ProdukKategori::latest()->get();

        $produk = Produk::with('kategori', 'gambar', 'produkstok')->where('istersedia', true);
        if ($this->kategori_id) {
            $produk->where('produk_kategori_id', $this->kategori_id);
        }
        if ($this->cariproduk) {
            $produk->where('nama', 'like', '%' . $this->cariproduk . '%')->orWhere('barcode', 'like', '%' . $this->cariproduk . '%');
        }
        $this->produk = $produk->take($this->take)->latest()->get();
        return view('livewire.admin.kasir-penjualan-produk-admin')->extends('layouts.main')->section('content');
    }
}
