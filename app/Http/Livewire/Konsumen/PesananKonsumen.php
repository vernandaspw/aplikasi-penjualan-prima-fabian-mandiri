<?php

namespace App\Http\Livewire\Konsumen;

use App\Models\Transaksi;
use Livewire\Component;

class PesananKonsumen extends Component
{
    public $transaksi;
    public $cari;


    public function render()
    {
        if (auth('konsumen')->check()) {
            $this->transaksi = Transaksi::with('transaksiitem')->where('konsumen_id', auth('konsumen')->user()->id)->latest()->get();
        }else {
            $this->transaksi = 'login';
        }
        return view('livewire.konsumen.pesanan-konsumen');
    }
}
