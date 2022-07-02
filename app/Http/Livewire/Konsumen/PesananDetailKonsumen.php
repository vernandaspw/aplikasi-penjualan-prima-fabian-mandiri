<?php

namespace App\Http\Livewire\Konsumen;

use App\Models\Transaksi;
use Livewire\Component;

class PesananDetailKonsumen extends Component
{
    public $transaksi = [];
    public function mount($no)
    {
        $this->transaksi = Transaksi::with('konsumen','transaksiitem', 'metodekirim', 'metodepembayaran')->where('no_transaksi', $no)->where('konsumen_id', auth('konsumen')->user()->id)->first();

    }
    public function render()
    {
        return view('livewire.konsumen.pesanan-detail-konsumen')->extends('layouts.main')->section('content');
    }
}
