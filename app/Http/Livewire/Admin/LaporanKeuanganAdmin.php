<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class LaporanKeuanganAdmin extends Component
{
    public function render()
    {
        return view('livewire.admin.laporan-keuangan-admin')->extends('layouts.main')->section('content');
    }
}
