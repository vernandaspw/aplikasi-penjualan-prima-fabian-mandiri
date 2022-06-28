<?php

namespace App\Http\Livewire\Konsumen;

use App\Models\Produk;
use App\Models\ProdukKategori;
use App\Models\ProdukMerek;
use Livewire\Component;

class ProdukKonsumen extends Component
{
    public $kategori, $merek, $nama = '';

    public $namakategori, $namamerek;

    public $produk;

    public $take = 10;
    public $jmlproduk;


    protected $queryString = [
        'kategori' => ['except' => ''],
        'merek' => ['except' => ''],
        'nama' => ['except' => '']
    ];

    public function lanjut()
    {
        $this->take = $this->take + 10;
    }


    public function render()
    {
        if ($this->kategori) {
            $this->namakategori = ProdukKategori::find($this->kategori)->nama;
        }
        if ($this->merek) {
            $this->namamerek = ProdukMerek::find($this->merek)->nama;
        }

        $produk = Produk::with('transaksiitem', 'produkulasan')->where('istersedia', true);
        if ($this->kategori) {
            $produk->where('produk_kategori_id', 'like', '%' . $this->kategori . '%');
        }
        if ($this->merek) {
            $produk->where('produk_merek_id', 'like', '%' . $this->merek . '%');
        }
        if ($this->nama) {
            $produk->where('nama', 'like', '%' . $this->nama . '%');
        }
        $this->produk =  $produk->latest()->take($this->take)->get();

        $jmlproduk = Produk::where('istersedia', true);
        if ($this->kategori) {
            $jmlproduk->where('produk_kategori_id', 'like', '%' . $this->kategori . '%');
        }
        if ($this->merek) {
            $jmlproduk->where('produk_merek_id', 'like', '%' . $this->merek . '%');
        }
        $this->jmlproduk = $jmlproduk->get()->count();



        return view('livewire.konsumen.produk-konsumen')->extends('layouts.main')->section('content');
    }
}
