<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class CatatTransaksiAdmin extends Component
{
    public function render()
    {
        return view('livewire.admin.catat-transaksi-admin')->extends('layouts.main')->section('content');
    }
}
