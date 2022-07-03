<?php

namespace App\Http\Livewire\Konsumen;

use App\Models\Transaksi;
use Livewire\Component;

class RiwayatPesananKonsumen extends Component
{
    public $data = [];
    public function mount($no)
    {
        $this->data = Transaksi::with('konsumen','transaksiitem', 'metodekirim', 'metodepembayaran', 'transaksilog')->where('no_transaksi', $no)->where('konsumen_id', auth('konsumen')->user()->id)->first();

    }
    public function render()
    {
        return view('livewire.konsumen.riwayat-pesanan-konsumen')->extends('layouts.main')->section('content');
    }
}
