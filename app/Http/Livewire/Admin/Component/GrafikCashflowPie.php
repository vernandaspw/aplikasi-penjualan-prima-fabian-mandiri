<?php

namespace App\Http\Livewire\Admin\Component;

use App\Models\Transaksi;
use App\Models\TransaksiJenis;
use App\Models\TransaksiKategori;
use Livewire\Component;

class GrafikCashflowPie extends Component
{
    public $penjualan, $pemasukan, $pengeluaran;
    public function render()
    {
        $penjualan = TransaksiKategori::where('nama', 'penjualan')->first();
        $pemasukan = TransaksiJenis::where('nama', 'pemasukan')->first();
        $pengeluaran = TransaksiJenis::where('nama', 'pengeluaran')->first();

        $this->penjualan = Transaksi::where('transaksi_kategori_id', $penjualan->id)->where('islunas', true)->get()->sum('total_pembayaran');
        $this->pemasukan = Transaksi::where('transaksi_jenis_id', $pemasukan->id)->where('islunas', true)->get()->sum('total_pembayaran');
        $this->pengeluaran = Transaksi::where('transaksi_jenis_id', $pengeluaran->id)->where('islunas', true)->get()->sum('total_pembayaran');

        return view('livewire.admin.component.grafik-cashflow-pie')->extends('layouts.main')->section('content');
    }
}
