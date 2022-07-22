<?php

namespace App\Http\Livewire\Konsumen;

use App\Models\Transaksi;
use App\Models\TransaksiItem;
use Illuminate\Contracts\Database\Eloquent\Builder;
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

        // $transaksi = Transaksi::with('transaksiitem')->where('konsumen_id', auth('konsumen')->user()->id)->latest()->get();
        $data = TransaksiItem::with('produk', 'transaksi')->whereNull('produk_ulasan_id')->where('terjual', true)->latest();

        // $data->with(['transaksi' => function ($q) {
        //     $q->where('transaksis.konsumen_id', auth('konsumen')->user()->id);
        // }]);
        $data->whereHas('transaksi', function (Builder $query) {
            $query->where('konsumen_id', auth('konsumen')->user()->id);
        });
        // dd($data->get());
        $this->transaksiitem = $data->get();
        // dd($transaksiitem['transaksi']);
        // $cek =   $transaksiitem->transaksi->where('status', 'selesai')->latest()->get();
        // dd($cek);
        // $this->transaksiitem
        return view('livewire.konsumen.beri-ulasan-konsumen')->extends('layouts.main')->section('content');
    }
}
