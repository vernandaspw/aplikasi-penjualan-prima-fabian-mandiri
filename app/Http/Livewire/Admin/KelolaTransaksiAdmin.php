<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class KelolaTransaksiAdmin extends Component
{
    public function render()
    {
        return view('livewire.admin.kelola-transaksi-admin')->extends('layouts.main')->section('content');
    }
}
