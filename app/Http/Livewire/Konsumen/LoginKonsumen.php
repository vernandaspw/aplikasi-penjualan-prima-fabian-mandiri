<?php

namespace App\Http\Livewire\Konsumen;

use Livewire\Component;

class LoginKonsumen extends Component
{
    public function render()
    {
        return view('livewire.konsumen.login-konsumen')->extends('layouts.main')->section('content');
    }
}
