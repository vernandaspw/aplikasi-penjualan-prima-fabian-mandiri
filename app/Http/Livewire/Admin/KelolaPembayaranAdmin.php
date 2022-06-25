<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class KelolaPembayaranAdmin extends Component
{
    public function render()
    {
        return view('livewire.admin.kelola-pembayaran-admin')->extends('layouts.main')->section('content');
    }
}
