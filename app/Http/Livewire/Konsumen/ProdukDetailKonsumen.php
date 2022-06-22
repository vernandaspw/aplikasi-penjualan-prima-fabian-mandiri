<?php

namespace App\Http\Livewire\Konsumen;

use Livewire\Component;

class ProdukDetailKonsumen extends Component
{
    public $produkid;

    public function mount($id)
    {
        $this->produkid = $id;
    }

    public function render()
    {
        return view('livewire.konsumen.produk-detail-konsumen')->extends('layouts.main')->section('content');
    }
}
