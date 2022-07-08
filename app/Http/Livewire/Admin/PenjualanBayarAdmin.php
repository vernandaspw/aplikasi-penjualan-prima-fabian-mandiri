<?php

namespace App\Http\Livewire\Admin;

use App\Models\Transaksi;
use Livewire\Component;

class PenjualanBayarAdmin extends Component
{
    public $transaksi = [];

    public $alert;

    public $diterima;
    public $kembalian;

    public function updated()
    {
        if ($this->diterima) {
            // if ($this->diterma < $this) {
            //     # code...
            // }
            // $total = $this->transaksi;
            // $this->kembalian = $total->total_pembayaran - $this->diterima;
        }
    }

    public function mount($id)
    {
        $this->transaksi = Transaksi::with('metodekirim', 'metodepembayaran')->where('no_transaksi', $id)->first();
    }
    public function render()
    {
        return view('livewire.admin.penjualan-bayar-admin')->extends('layouts.main')->section('content');
    }
}
