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

    public $mySelected;

    public function check($id)
    {
        $cek = KeranjangItem::find($id);
        if ($cek->selected) {
            $cek->update([
                'selected' => false
            ]);
        } else {
            $cek->update([
                'selected' => true
            ]);
        }
    }

    public function mount()
    {
        $data = KeranjangItem::where('konsumen_id', auth('konsumen')->user()->id)->where('selected', true)->get();
        if ($data) {
            foreach ($data as $d) {
                $cek = KeranjangItem::find($d->id)->update([
                    'selected' => false
                ]);
            }
        }


    }

    public function tambahitem($id)
    {
        $data = KeranjangItem::with('produk')->find($id);
        if ($data->qty <= 999999999) {
            if ($data->qty < $data->produk->produkstok->po) {
                $qty = $data->qty + 1;
                $totalharga =  $data->produk->harga_jual * $qty;
                $qty_update = $data->update([
                    'qty' => $qty,
                    'total_harga' => $totalharga
                ]);
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
            $qty_update = $data->update([
                'qty' => $qty,
                'total_harga' => $totalharga
            ]);
        } else {
        }
    }
    public function deleteitem($id)
    {
        KeranjangItem::with('produk')->find($id)->delete();
    }

    public function render()
    {
        $this->keranjangitem = KeranjangItem::with('produk', 'keranjang')->where('konsumen_id', auth('konsumen')->user()->id)->latest()->get();
        $this->totalbelanja = KeranjangItem::with('produk', 'keranjang')->where('konsumen_id', auth('konsumen')->user()->id)->latest()->get()->sum('total_harga');

        return view('livewire.konsumen.keranjang-konsumen')->extends('layouts.main')->section('content');
    }
}
