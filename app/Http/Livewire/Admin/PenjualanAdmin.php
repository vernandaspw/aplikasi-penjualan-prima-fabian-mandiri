<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class PenjualanAdmin extends Component
{
    public $penjualanproduk = true;

    public function pageproduk()
    {
        $this->penjualanproduk = true;
    }

    public function pagemanual()
    {
        $this->penjualanproduk = false;
    }

    public function render()
    {
        return view('livewire.admin.penjualan-admin')->extends('layouts.main')->section('content');
    }
}
