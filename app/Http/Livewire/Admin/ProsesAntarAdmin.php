<?php

namespace App\Http\Livewire\Admin;

use App\Models\ProdukStok;
use App\Models\ProdukStokLog;
use App\Models\Transaksi;
use App\Models\TransaksiItem;
use App\Models\TransaksiJenis;
use App\Models\TransaksiKategori;
use App\Models\TransaksiLog;
use Livewire\Component;

class ProsesAntarAdmin extends Component
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
        $transaksi = Transaksi::with('konsumen', 'transaksi_kategori', 'transaksi_jenis', 'metodekirim', 'metodepembayaran');
        if ($this->cari_no) {
            $transaksi->where('no_transaksi', 'like', '%' . $this->cari_no . '%');
        }
        if ($this->selectJenis) {
            $transaksi->where('transaksi_jenis_id', $this->jenis->id);
            if ($this->selectKategori) {
                $transaksi->where('transaksi_kategori_id', $this->kategori->id);
            }
        }

        $this->transaksi = $transaksi->where('status', 'sedang_antar')->orWhere('status', 'retur')->take($this->take)->latest()->get();

        $this->jmlproduk = Transaksi::with('konsumen', 'transaksi_kategori', 'transaksi_jenis', 'metodekirim', 'metodepembayaran')->where('status', 'sedang_antar')->count();
        return view('livewire.admin.proses-antar-admin')->extends('layouts.main')->section('content');
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
            'status' => 'diterima'
        ]);
        $this->emit('success', ['pesan' => 'berhasil memperbarui status pesanan menjadi diterima']);
    }

    public function selesai($id)
    {
        $transaksi =  Transaksi::with('transaksiitem', 'konsumen', 'transaksi_kategori', 'transaksi_jenis', 'metodekirim', 'metodepembayaran')->find($id);

        $transaksi->update([
            'status' => 'selesai',
            'islunas' => true
        ]);
        TransaksiLog::create([
            'transaksi_id' => $id,
            'status' => 'selesai'
        ]);

        foreach ($transaksi->transaksiitem as $item) {
            $transaksiitem = TransaksiItem::find($item->id);

            $transaksiitem->update([
                'terjual' => true,
            ]);

            // $produkstok = ProdukStok::where('produk_id', $item->produk_id)->first();
            // $produkstok->update([
            //     'real' => $produkstok->real - $item->qty,
            // ]);

            // ProdukStokLog::create([
            //     'produk_stok_id' => $produkstok->id,
            //     'jenis' => 'keluar',
            //     'real' => $item->qty,
            //     'keterangan' => 'pre order'
            // ]);
        }

        $this->emit('success', ['pesan' => 'berhasil menyelesaikan pesanan']);
    }

    public function batal($id)
    {
        $transaksi =  Transaksi::with('transaksiitem', 'konsumen', 'transaksi_kategori', 'transaksi_jenis', 'metodekirim', 'metodepembayaran')->find($id);
        // batal ketika konsumen belum bayar, ubah status jadi batal
        if ($transaksi->status == 'konfirm') {
            $status = 'batal';
        }

        // batal ketika proses_pembayaran, ubah status jadi batal
        if ($transaksi->status == 'proses_pembayaran') {
            $status = 'batal';
        }

        $transaksi->update([
            'status' => $status
        ]);
        TransaksiLog::create([
            'transaksi_id' => $id,
            'status' => $status
        ]);

        $this->emit('success', ['pesan' => 'berhasil batalkan pesanan']);
    }
    public function retur($id)
    {
        $transaksi =  Transaksi::with('transaksiitem', 'konsumen', 'transaksi_kategori', 'transaksi_jenis', 'metodekirim', 'metodepembayaran')->find($id);

        $transaksi->update([
            'status' => 'retur',
        ]);
        TransaksiLog::create([
            'transaksi_id' => $id,
            'status' => 'retur'
        ]);

        $this->emit('success', ['pesan' => 'berhasil retur pesanan']);
    }

    public function returditerima($id)
    {
        $transaksi =  Transaksi::with('transaksiitem', 'konsumen', 'transaksi_kategori', 'transaksi_jenis', 'metodekirim', 'metodepembayaran')->find($id);

        $transaksi->update([
            'status' => 'selesai',
        ]);
        TransaksiLog::create([
            'transaksi_id' => $id,
            'status' => 'selesai'
        ]);
        $this->emit('success', ['pesan' => 'berhasil terima retur pesanan']);
    }
}
