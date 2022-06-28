<?php

namespace App\Http\Livewire\Konsumen;

use App\Models\Produk;
use App\Models\ProdukGaleri;
use App\Models\ProdukUlasan;
use Livewire\Component;

class ProdukDetailKonsumen extends Component
{
    public $produk, $produkulasan, $gambar = [];
    public $jml_ulasan;

    public $lihatgambar;

    public $take = 5;

    public function lainnya()
    {
        $this->take = $this->take + 5;
    }
    

    public function lihatgambar($id)
    {
        $this->lihatgambar = ProdukGaleri::find($id);
    }

    public function mount($id)
    {
        $this->produk = Produk::with('gambar','kategori', 'merek', 'transaksiitem', 'produkulasan', 'produkstok')->where('istersedia', true)->find($id);
        $this->gambar = ProdukGaleri::where('produk_id', $this->produk->id)->orderBy('no', 'desc')->get();
        // dd($this->gambar);
        $this->jml_ulasan = ProdukUlasan::with('konsumen', 'produk')->where('produk_id', $id)->where('ulasan', '!=', null)->count();

    
    }

    public function render()
    {

        $this->produkulasan = ProdukUlasan::where('produk_id', $this->produk->id)->take($this->take)->get();
        return view('livewire.konsumen.produk-detail-konsumen')->extends('layouts.main')->section('content');
    }
}
