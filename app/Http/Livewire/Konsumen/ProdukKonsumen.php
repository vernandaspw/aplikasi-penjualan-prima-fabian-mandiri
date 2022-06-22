<?php

namespace App\Http\Livewire\Konsumen;

use App\Models\Produk;
use Livewire\Component;

class ProdukKonsumen extends Component
{
    public $kategori, $merek = '';

    public $produk;

    protected $queryString = [
        'kategori' => ['except' => ''],
        'merek' => ['except' => '']
    ];

    public function render()
    {
        $this->produk = Produk::
        where('produk_kategori_id', 'like', '%'.$this->kategori . '%')
        ->where('produk_merek_id', 'like', '%'.$this->merek . '%')
        ->latest()->get();
        return view('livewire.konsumen.produk-konsumen')->extends('layouts.main')->section('content');
    }
}
