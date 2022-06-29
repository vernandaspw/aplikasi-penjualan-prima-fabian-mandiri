<?php

namespace App\Http\Livewire\Konsumen;

use App\Models\KeranjangItem;
use App\Models\Konsumen;
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
        $this->produk = Produk::with('gambar', 'kategori', 'merek', 'transaksiitem', 'produkulasan', 'produkstok')->where('istersedia', true)->find($id);
        $this->gambar = ProdukGaleri::where('produk_id', $this->produk->id)->orderBy('no', 'desc')->get();
        // dd($this->gambar);
        $this->jml_ulasan = ProdukUlasan::with('konsumen', 'produk')->where('produk_id', $id)->where('ulasan', '!=', null)->count();
    }

    public function render()
    {

        $this->produkulasan = ProdukUlasan::where('produk_id', $this->produk->id)->take($this->take)->get();
        return view('livewire.konsumen.produk-detail-konsumen')->extends('layouts.main')->section('content');
    }

    public function tambahkecart($produkid)
    {
        $konsumen = Konsumen::with('keranjang')->find(auth('konsumen')->user()->id);
        $produk = Produk::find($produkid);

        $cart_item = KeranjangItem::with('produk')->where('konsumen_id', $konsumen->id)->where('produk_id', $produkid)->first();

        if ($cart_item) {
            if ($cart_item->qty <= 999999999) {
                if ($cart_item->qty < $cart_item->produk->produkstok->po) {
                    $qty = $cart_item->qty + 1;
                    $totalharga =  $cart_item->produk->harga_jual * $qty;
                    $totalmodal =  $cart_item->produk->harga_modal * $qty;
                    $totalberat =  $cart_item->produk->berat_kg * $qty;
                    $qty_update = $cart_item->update([
                        'qty' => $qty,
                        'total_harga' => $totalharga,
                        'total_modal' => $totalmodal,
                        'total_berat' => $totalberat
                    ]);
                    $this->emit('success', ['pesan' => 'berhasil tambah produk ke keranjang']);
                } else {
                    $this->emit('error', ['pesan' => 'stok produk tidak cukup']);
                }
            } else {
                $this->emit('error', ['pesan' => 'qty di keranjang telah penuh']);
            }
        } else {
            if ($produk->produkstok->po >= 1) {
                $cartitem = KeranjangItem::create([
                    'konsumen_id' => auth('konsumen')->user()->id,
                    'keranjang_id' => $konsumen->keranjang->id,
                    'produk_id' => $produkid,
                    'qty' => 1,
                    'total_harga' => $produk->harga_jual,
                    'total_modal' => $produk->harga_modal,
                    'total_berat' => $produk->berat_kg
                ]);
                $this->emit('success', ['pesan' => 'berhasil tambah produk ke keranjang']);
            }else {
                $this->emit('error', ['pesan' => 'stok produk tidak cukup']);
            }
        }
    }
}
