<?php

namespace App\Http\Livewire\Admin;

use App\Models\ProdukStok;
use Livewire\Component;

class KelolaStokAdmin extends Component
{
    public $produkstok;
    public $cariproduk;

    public $take = 10;
    public $jmlprodukstok;

    public function render()
    {
        $stok = ProdukStok::with('produk')->latest();
        if ($this->cariproduk) {
            $stok->produk->where('nama', $this->cariproduk)->orWhere('barcode', $this->cariproduk);
        }
        $this->produkstok = $stok->get();

        $this->jmlprodukstok = $stok->count();
        return view('livewire.admin.kelola-stok-admin')->extends('layouts.main')->section('content');
    }
}
