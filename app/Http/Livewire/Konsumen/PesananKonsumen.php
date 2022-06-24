<?php

namespace App\Http\Livewire\Konsumen;

use Livewire\Component;

class PesananKonsumen extends Component
{
    public $transaksi;
    public $cari;
    public function render()
    {
        if (auth('konsumen')->check()) {
            $this->transaksi = null;
        }else {
            $this->transaksi = 'login';
        }
        return view('livewire.konsumen.pesanan-konsumen');
    }
}
