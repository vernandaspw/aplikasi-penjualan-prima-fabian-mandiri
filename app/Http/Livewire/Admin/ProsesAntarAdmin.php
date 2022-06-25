<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class ProsesAntarAdmin extends Component
{
    public function render()
    {
        return view('livewire.admin.proses-antar-admin')->extends('layouts.main')->section('content');
    }
}
