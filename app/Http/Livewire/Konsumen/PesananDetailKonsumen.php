<?php

namespace App\Http\Livewire\Konsumen;

use Livewire\Component;

class PesananDetailKonsumen extends Component
{
    public function mount($no)
    {
        dd($no);
    }
    public function render()
    {
        return view('livewire.konsumen.pesanan-detail-konsumen')->extends('layouts.main')->section('content');
    }
}
