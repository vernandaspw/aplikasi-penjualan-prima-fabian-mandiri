<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class LaporanProdukAdmin extends Component
{
    public function render()
    {
        return view('livewire.admin.laporan-produk-admin')->extends('layouts.main')->section('content');
    }
}
