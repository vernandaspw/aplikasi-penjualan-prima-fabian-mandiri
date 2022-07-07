<?php

namespace App\Http\Livewire\Admin;

use App\Models\KeranjangItem;
use App\Models\Pegawai;
use App\Models\Produk;
use App\Models\ProdukKategori;
use Livewire\Component;

class PenjualanProdukAdmin extends Component
{
    public $keranjangitem, $kategori = [];

    public $jml_belanja, $totalbelanja;

    public $show = false;
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

        $this->keranjangitem = KeranjangItem::with('produk')->where('pegawai_id', auth('pegawai')->user()->id)->get();
        $this->jml_belanja = KeranjangItem::with('produk', 'keranjang')->where('pegawai_id', auth('pegawai')->user()->id)->get()->count();
        $this->totalbelanja = KeranjangItem::with('produk', 'keranjang')->where('pegawai_id', auth('pegawai')->user()->id)->get()->sum('total_harga');

        return view('livewire.admin.penjualan-produk-admin')->extends('layouts.main')->section('content');
    }

    // public function tambah_produk_baru()
    // {
    //     $baru = KeranjangItem::create([
    //         ''
    //     ]);
    // }

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
                $this->emit('success', ['pesan' => 'berhasil tambah produk ke keranjang']);
            }else {
                $this->emit('error', ['pesan' => 'stok produk tidak cukup']);
            }
        }
    }

    public function showOff()
    {
        $this->show = false;
    }

    public function hapuscartitem($id)
    {
        KeranjangItem::with('produk')->find($id)->delete();

        $this->show = true;
    }

    public function tambahitem($id)
    {
        $data = KeranjangItem::with('produk')->find($id);
        if ($data->qty <= 999999999) {
            if ($data->qty < $data->produk->produkstok->po) {
                $qty = $data->qty + 1;
                $totalharga =  $data->produk->harga_jual * $qty;
                $totalmodal =  $data->produk->harga_modal * $qty;
                $totalberat =  $data->produk->berat_kg * $qty;
                $qty_update = $data->update([
                    'qty' => $qty,
                    'total_harga' => $totalharga,
                    'total_modal' => $totalmodal,
                    'total_berat' => $totalberat
                ]);
                $this->show = true;
            } else {
            }
        } else {
        }
    }
    public function kurangitem($id)
    {
        $data = KeranjangItem::with('produk')->find($id);
        if ($data->qty > 1) {
            $qty = $data->qty - 1;
            $totalharga =  $data->produk->harga_jual * $qty;
            $totalmodal =  $data->produk->harga_modal * $qty;
            $totalberat =  $data->produk->berat_kg * $qty;
            $qty_update = $data->update([
                'qty' => $qty,
                'total_harga' => $totalharga,
                'total_modal' => $totalmodal,
                'total_berat' => $totalberat
            ]);
            $this->show = true;
        } else {
        }
    }
}
