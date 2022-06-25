<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class PesananMasukAdmin extends Component
{
    public function render()
    {
        return view('livewire.admin.pesanan-masuk-admin')->extends('layouts.main')->section('content');
    }
}
