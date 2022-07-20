<?php

namespace App\Http\Livewire\Admin;

use App\Models\ProdukStok;
use App\Models\ProdukStokLog;
use App\Models\Transaksi;
use App\Models\TransaksiJenis;
use App\Models\TransaksiKategori;
use App\Models\TransaksiLog;
use Livewire\Component;

class PesananMasukAdmin extends Component
{
    public $transaksi = [];
    public $jenis, $kategori;
    public $take = 10;
    public $jmlproduk;
    public $selectJenis, $selectKategori;
    public $cari_no;

    public $status, $islunas;

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
        $transaksi = Transaksi::with('konsumen', 'transaksi_kategori', 'transaksi_jenis', 'metodekirim', 'metodepembayaran')->where('status', 'sedang_dikemas');
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
        return view('livewire.admin.pesanan-masuk-admin')->extends('layouts.main')->section('content');
    }

    public function antar($id)
    {
        $transaksi =  Transaksi::with('transaksiitem', 'konsumen', 'transaksi_kategori', 'transaksi_jenis', 'metodekirim', 'metodepembayaran')->find($id);
        // dd($transaksi->metodekirim->metode);

        $transaksi->update([
            'status' => 'sedang_antar'
        ]);

        TransaksiLog::create([
            'transaksi_id' => $id,
            'status' => 'sedang_antar',
            'keterangan' => $transaksi->metodekirim->metode
        ]);

        // kurangi stok real
        foreach ($transaksi->transaksiitem as $item) {
            $produkstok = ProdukStok::where('produk_id', $item->produk_id)->first();
            $produkstok->update([
                'real' => $produkstok->real - $item->qty,
            ]);

            ProdukStokLog::create([
                'produk_stok_id' => $produkstok->id,
                'jenis' => 'keluar',
                'real' => $item->qty,
                'keterangan' => 'pre order'
            ]);
        }

        $this->emit('success', ['pesan' => 'segera antar pesanan']);
    }
}
