<?php

namespace App\Http\Livewire\Admin;

use App\Models\Transaksi;
use Livewire\Component;

class PenjualanBayarAdmin extends Component
{
    public $transaksi = [];

    public $diterima;
    public $kembalian;

    public function mount($id)
    {
        $this->transaksi = Transaksi::with('metodekirim', 'metodepembayaran')->where('no_transaksi', $id)->first();
    }
    public function render()
    {
        return view('livewire.admin.penjualan-bayar-admin')->extends('layouts.main')->section('content');
    }
}
