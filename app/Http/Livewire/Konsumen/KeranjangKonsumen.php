<?php

namespace App\Http\Livewire\Konsumen;

use App\Models\KeranjangItem;
use App\Models\Konsumen;
use Livewire\Component;

class KeranjangKonsumen extends Component
{
    public $qty = 1;

    public $keranjangitem = [];

    public $totalbelanja;

    public function tambahitem($id)
    {
        $data = KeranjangItem::with('produk')->find($id);
        if ($data->qty <= 999999999) {

            if ($data->qty <= $data->produk->produkstok->po) {
            }else {
                $qty = $data->qty + 1;
                $totalharga =  $data->produk->harga_jual * $qty;
                $qty_update = $data->update([
                    'qty' => $qty,
                    'total_harga' => $totalharga
                ]);
            }
        }else {
        }
    }
    public function kurangitem($id)
    {
        $data = KeranjangItem::with('produk')->find($id);
        if ($data->qty <= 1) {
        }else {
            $qty = $data->qty - 1;
            $totalharga =  $data->produk->harga_jual * $qty;
            $qty_update = $data->update([
                'qty' => $qty,
                'total_harga' => $totalharga
            ]);
        }
    }
    public function deleteitem($id)
    {
        KeranjangItem::with('produk')->find($id)->delete();
    }

    public function render()
    {
         $this->keranjangitem = KeranjangItem::with('produk','keranjang')->where('konsumen_id', auth('konsumen')->user()->id)->latest()->get();
         $this->totalbelanja = KeranjangItem::with('produk','keranjang')->where('konsumen_id', auth('konsumen')->user()->id)->latest()->get()->sum('totalharga');

        return view('livewire.konsumen.keranjang-konsumen')->extends('layouts.main')->section('content');
    }
}
