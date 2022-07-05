<?php

namespace App\Http\Livewire\Admin;

use App\Models\Kasir;
use App\Models\Produk;
use Livewire\Component;

class KasirPenjualanManualAdmin extends Component
{
    public $id_kasir;
    public $kasir;

    public function mount($id)
    {
        $this->id_kasir = $id;
    }

    public function render()
    {
        $this->kasir = Kasir::find($this->id_kasir);



        return view('livewire.admin.kasir-penjualan-manual-admin')->extends('layouts.main')->section('content');
    }
}
