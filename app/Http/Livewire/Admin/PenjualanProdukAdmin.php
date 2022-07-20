<?php

namespace App\Http\Livewire\Admin;

use App\Models\KeranjangItem;
use App\Models\Pegawai;
use App\Models\Produk;
use App\Models\ProdukKategori;
use Livewire\Component;

class PenjualanProdukAdmin extends Component
{
    public $kategori = [];

    public $take = 15;
    public $jmlproduk;

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
        // dd($this->produk);

        $this->jmlproduk = Produk::with('kategori', 'gambar', 'produkstok')->where('istersedia', true)->get()->count();

        return view('livewire.admin.penjualan-produk-admin')->extends('layouts.main')->section('content');
    }

    public function tambahkecart($produkid)
    {
        $pegawai = Pegawai::with('keranjang')->find(auth('pegawai')->user()->id);
        $produk = Produk::find($produkid);
        // dd($pegawai);

        $cart_item = KeranjangItem::with('produk')->where('pegawai_id', $pegawai->id)->where('produk_id', $produkid)->first();
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
                    $this->emit('refresh');
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
                    'pegawai_id' => auth('pegawai')->user()->id,
                    'keranjang_id' => $pegawai->keranjang->id,
                    'produk_id' => $produkid,
                    'qty' => 1,
                    'total_harga' => $produk->harga_jual,
                    'total_modal' => $produk->harga_modal,
                    'total_berat' => $produk->berat_kg
                ]);
                $this->emit('refresh');
                $this->emit('success', ['pesan' => 'berhasil tambah produk ke keranjang']);
            } else {
                $this->emit('error', ['pesan' => 'stok produk tidak cukup']);
            }
        }
    }
}
