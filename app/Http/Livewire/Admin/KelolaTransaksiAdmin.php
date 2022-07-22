<?php

namespace App\Http\Livewire\Admin;

use App\Models\MetodePembayaran;
use App\Models\Transaksi;
use App\Models\TransaksiJenis;
use App\Models\TransaksiKategori;
use App\Models\TransaksiLog;
use Livewire\Component;

class KelolaTransaksiAdmin extends Component
{
    public $transaksi = [];
    public $jenis, $kategori = [];
    public $take = 10;
    public $jml_item;
    public $selectJenis, $selectKategori;

    public $inputJenis, $inputKategori, $nominal, $catatan, $datetime, $metodepembayaran, $nama_konsumen, $nowa_konsumen;
    public $islunas = true;
    public $cari_no;

    public $pageBuat = false, $pageEdit = false;



    public function tutupForm()
    {
        if ($this->pageBuat == true) {
            $this->pageBuat = false;
        }
        if ($this->pageEdit == true) {
            $this->pageTutup = false;
        }
    }

    public function lanjut()
    {
        $this->take = $this->take + 10;
    }

    public function mount()
    {
        $this->jenis = TransaksiJenis::latest()->get();
        $this->datetime = date("Y-m-d H:i");
    }

    public function render()
    {
        if ($this->inputJenis) {
            $this->kategori = TransaksiKategori::where('transaksi_jenis_id', $this->inputJenis)->where('nama', '!=', 'penjualan')->latest()->get();
        }

        $this->metodepembayaran = MetodePembayaran::where('isaktif', true)->latest()->get();

        $transaksi = Transaksi::with('konsumen','transaksi_kategori', 'transaksi_jenis', 'metodekirim', 'metodepembayaran');
        if ($this->cari_no) {
            $transaksi->where('no_transaksi', 'like', '%'. $this->cari_no . '%');
        }
        // if ($this->selectJenis) {
        //     $transaksi->where('transaksi_jenis_id', $this->jenis->id);
        //     if ($this->selectKategori) {
        //         $transaksi->where('transaksi_kategori_id', $this->kategori->id);
        //     }
        // }


        $this->transaksi = $transaksi->take($this->take)->latest()->get();

        $this->jml_item = Transaksi::with('konsumen', 'transaksi_kategori', 'transaksi_jenis', 'metodekirim', 'metodepembayaran')->count();
        return view('livewire.admin.kelola-transaksi-admin')->extends('layouts.main')->section('content');
    }

    public function formBuat()
    {
        $this->pageBuat = true;
    }

    public function buatTransaksi()
    {
        $this->validate([

        ]);

        $buat = Transaksi::create([
            'pegawai_id' => auth('pegawai')->user()->id,
            'jenis_transaksi_id' => $this->inputJenis,
            'kategori_transaksi_id' => $this->inputKategori,
            'total_pembayaran' => $this->nominal,
            'catatan' => $this->catatan,
            'created_at' => $this->datetime
        ]);

        if ($buat) {
            TransaksiLog::create([

            ]);
        }
    }
}
