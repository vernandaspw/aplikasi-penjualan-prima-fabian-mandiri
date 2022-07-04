<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class KelolaProdukKategoriAdmin extends Component
{
    public function render()
    {
        return view('livewire.admin.kelola-produk-kategori-admin')->extends('layouts.main')->section('content');
    }

}
