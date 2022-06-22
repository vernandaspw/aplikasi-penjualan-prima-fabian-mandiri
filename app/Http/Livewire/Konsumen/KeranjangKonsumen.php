<?php

namespace App\Http\Livewire\Konsumen;

use Livewire\Component;

class KeranjangKonsumen extends Component
{
    public $qty = 1;

    public function tambah()
    {
        if ($this->qty >= 999999999) {
        }else {
            $this->qty++;
        }
    }

    public function kurang()
    {

        if ($this->qty <=1) {
            # code...
        }else {
            $this->qty--;
        }
    }

    public function delete()
    {
        # code...
    }

    public function render()
    {
        return view('livewire.konsumen.keranjang-konsumen')->extends('layouts.main')->section('content');
    }
}
