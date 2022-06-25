<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class KelolaPengirimAdmin extends Component
{
    public function render()
    {
        return view('livewire.admin.kelola-pengirim-admin')->extends('layouts.main')->section('content');
    }
}
