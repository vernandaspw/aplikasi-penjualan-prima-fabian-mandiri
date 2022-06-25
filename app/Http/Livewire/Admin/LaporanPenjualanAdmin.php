<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class LaporanPenjualanAdmin extends Component
{
    public function render()
    {
        return view('livewire.admin.laporan-penjualan-admin')->extends('layouts.main')->section('content');
    }
}
