<?php

namespace App\Http\Livewire\Konsumen;

use App\Models\Transaksi;
use App\Models\TransaksiItem;
use Livewire\Component;

class BeriUlasanKonsumen extends Component
{
    public $transaksiitem = [];

    public function render()
    {
        // $transaksi = Transaksi::with('transaksiitem')->where('status', 'selesai')->latest()->get();
        // foreach ($transaksi->transaksiitem as $trx) {
        //     $data = $trx;
        // }

        // dd($data);

        $this->transaksiitem = TransaksiItem::with('produk', 'transaksi')->whereNull('produk_ulasan_id')->where('terjual', true)->latest()->get();
        // dd($transaksiitem['transaksi']);
        // $cek =   $transaksiitem->transaksi->where('status', 'selesai')->latest()->get();
        // dd($cek);
        // $this->transaksiitem
        return view('livewire.konsumen.beri-ulasan-konsumen')->extends('layouts.main')->section('content');
    }
}
