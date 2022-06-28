<?php

namespace App\Http\Livewire\Konsumen\Component;

use App\Models\KeranjangItem;
use Livewire\Component;

class IconCartKonsumen extends Component
{
    public $jml_itemcart;

    public function updating()
    {
        $this->jml_itemcart = KeranjangItem::with('produk')->where('konsumen_id', auth('konsumen')->user()->id)->get()->count();
    }

    public function render()
    {
        $this->jml_itemcart = KeranjangItem::with('produk')->where('konsumen_id', auth('konsumen')->user()->id)->get()->count();

        return view('livewire.konsumen.component.icon-cart-konsumen')->extends('layouts.main')->section('content');
    }
}
