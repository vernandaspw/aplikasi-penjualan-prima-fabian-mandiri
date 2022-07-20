<?php

namespace App\Http\Livewire\Konsumen;

use App\Models\Transaksi;
use App\Models\TransaksiLog;
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
        return view('livewire.konsumen.pesanan-konsumen')->extends('layouts.main')->section('content');
    }

    public function diterima($id)
    {
        $transaksi =  Transaksi::with('transaksiitem', 'konsumen', 'transaksi_kategori', 'transaksi_jenis', 'metodekirim', 'metodepembayaran')->find($id);

        $transaksi->update([
            'status' => 'diterima',
            'islunas' => $transaksi->islunas == true ? $transaksi->islunas : true
        ]);
        TransaksiLog::create([
            'transaksi_id' => $id,
            'status' => 'diterima',
            'keterangan' => 'diterima oleh'. auth('konsumen')->user()->nama
        ]);
        $this->emit('success', ['pesan' => 'berhasil terima pesanan']);
    }
}
