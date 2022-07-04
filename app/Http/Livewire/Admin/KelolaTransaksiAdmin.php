<?php

namespace App\Http\Livewire\Admin;

use App\Models\Transaksi;
use App\Models\TransaksiJenis;
use App\Models\TransaksiKategori;
use Livewire\Component;

class KelolaTransaksiAdmin extends Component
{
    public $transaksi = [];
    public $jenis, $kategori;
    public $take = 10;
    public $jmlproduk;
    public $selectJenis, $selectKategori;

    public $cari_no;

    public function lanjut()
    {
        $this->take = $this->take + 10;
    }

    public function mount()
    {
        $this->jenis = TransaksiJenis::latest()->get();
        $this->kategori = TransaksiKategori::latest()->get();
    }

    public function render()
    {
        $transaksi = Transaksi::with('konsumen','transaksi_kategori', 'transaksi_jenis', 'metodekirim', 'metodepembayaran');
        if ($this->cari_no) {
            $transaksi->where('no_transaksi', 'like', '%'. $this->cari_no . '%');
        }
        if ($this->selectJenis) {
            $transaksi->where('transaksi_jenis_id', $this->jenis->id);
            if ($this->selectKategori) {
                $transaksi->where('transaksi_kategori_id', $this->kategori->id);
            }
        }

        $this->transaksi = $transaksi->take($this->take)->latest()->get();
        return view('livewire.admin.kelola-transaksi-admin')->extends('layouts.main')->section('content');
    }

    public function terima_pembayaran( )
    {
        # code...
    }
}
