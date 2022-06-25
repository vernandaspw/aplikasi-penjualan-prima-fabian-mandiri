<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class KelolaPengaturanAdmin extends Component
{
    public function render()
    {
        return view('livewire.admin.kelola-pengaturan-admin')->extends('layouts.main')->section('content');
    }
}
