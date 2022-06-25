<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class PenjualanAdmin extends Component
{
    public function render()
    {
        return view('livewire.admin.penjualan-admin')->extends('layouts.main')->section('content');
    }
}
