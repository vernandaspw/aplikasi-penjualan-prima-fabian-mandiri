<?php

namespace App\Http\Livewire\Admin\Laporan;

use App\Models\ProdukStok;
use Livewire\Component;

class LaporanProdukStok extends Component
{
    public $produkstok = [];
    public $jenis, $kategori;
    public $take = 20;
    public $jml_item;
    public $selectJenis, $selectKategori;

    public $cari_no;

    public $start_date, $end_date;

    public function lanjut()
    {
        $this->take = $this->take + 10;
    }

    public function render()
    {
        $produkstok = ProdukStok::with('produk');
        // if ($this->cariproduk) {
        //     $this->produk = $produk->where('nama', 'LIKE', '%' . $this->cariproduk . '%')->orWhere('barcode', 'like', '%' . $this->cariproduk . '%')->latest()->take($this->take)->get();
        // }
        // if ($this->start_date && $this->end_date) {
        //     $produk->whereBetween('created_at', [$this->start_date, $this->end_date]);
        //     $this->take = $this->jml_item;
        // }

        $this->produkstok = $produkstok->latest()->take($this->take)->get();
        // dd($this->produk);

        // $this->jmlkategori = ProdukKategori::get()->count();
        // $this->jmlmerek = ProdukMerek::get()->count();

        // $this->kategori = ProdukKategori::latest()->get();
        // $this->merek = ProdukMerek::latest()->get();

        $this->jml_item = ProdukStok::get()->count();
        return view('livewire.admin.laporan.laporan-produk-stok')->extends('layouts.main')->section('content');
    }


}
