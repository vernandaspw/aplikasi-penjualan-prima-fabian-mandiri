<?php

namespace App\Http\Livewire\Admin;

use App\Models\Konsumen;
use App\Models\Produk;
use App\Models\Transaksi;
use App\Models\TransaksiJenis;
use App\Models\TransaksiKategori;
use Livewire\Component;

class DashboardAdmin extends Component
{
    public $penjualan, $pemasukan, $pengeluaran;
    public $jml_konsumen, $jml_produk, $jml_penjualan, $jml_transaksi;


    public function render()
    {
        $penjualan = TransaksiKategori::where('nama', 'penjualan')->first();
        $pemasukan = TransaksiJenis::where('nama', 'pemasukan')->first();
        $pengeluaran = TransaksiJenis::where('nama', 'pengeluaran')->first();

        $this->penjualan = Transaksi::where('transaksi_kategori_id', $penjualan->id)->where('islunas', true)->get()->sum('total_pembayaran');
        $this->pemasukan = Transaksi::where('transaksi_jenis_id', $pemasukan->id)->where('islunas', true)->get()->sum('total_pembayaran');
        $this->pengeluaran = Transaksi::where('transaksi_jenis_id', $pengeluaran->id)->where('islunas', true)->get()->sum('total_pembayaran');

        $this->jml_konsumen = Konsumen::get()->count();
        $this->jml_produk = Produk::get()->count();
        $this->jml_penjualan = Transaksi::where('transaksi_kategori_id', $penjualan->id)->get()->count();
         $this->jml_transaksi = Transaksi::get()->count();

        return view('livewire.admin.dashboard-admin')->extends('layouts.main')->section('content');
    }
}
