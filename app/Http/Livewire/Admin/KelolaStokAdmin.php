<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class KelolaStokAdmin extends Component
{
    public function render()
    {
        return view('livewire.admin.kelola-stok-admin')->extends('layouts.main')->section('content');
    }
}
