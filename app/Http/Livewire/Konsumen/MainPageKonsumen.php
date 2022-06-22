<?php

namespace App\Http\Livewire\Konsumen;

use Livewire\Component;

class MainPageKonsumen extends Component
{

    public $page = 0;

    public function beranda()
    {
        $this->page = 0;
    }

    public function pesanan()
    {
        $this->page = 1;
    }

    public function akun()
    {
        $this->page = 2;
    }

    public function render()
    {
        return view('livewire.konsumen.main-page-konsumen')->extends('layouts.main')->section('content');
    }
}
