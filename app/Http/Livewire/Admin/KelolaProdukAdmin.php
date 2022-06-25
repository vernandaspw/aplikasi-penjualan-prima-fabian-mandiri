<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class KelolaProdukAdmin extends Component
{
    public function render()
    {
        return view('livewire.admin.kelola-produk-admin')->extends('layouts.main')->section('content');
    }
}
