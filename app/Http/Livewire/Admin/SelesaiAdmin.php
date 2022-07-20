<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class SelesaiAdmin extends Component
{
    
    public function render()
    {
        return view('livewire.admin.selesai-admin')->extends('layouts.main')->section('content');
    }
}
