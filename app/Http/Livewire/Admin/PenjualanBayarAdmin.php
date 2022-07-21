<?php

namespace App\Http\Livewire\Admin;

use App\Models\ProdukStok;
use App\Models\ProdukStokLog;
use App\Models\Transaksi;
use App\Models\TransaksiItem;
use App\Models\TransaksiLog;
use Livewire\Component;

class PenjualanBayarAdmin extends Component
{
    public $transaksi;

    public $alert;

    public $diterima;
    public $kembalian;

    public function updated()
    {
        if ($this->diterima) {
            $total = $this->transaksi;
            $this->kembalian =  $this->diterima - $total->total_pembayaran;
        }
    }

    public function mount($id)
    {
        $this->transaksi = Transaksi::with('metodekirim', 'metodepembayaran')->where('no_transaksi', $id)->first();

        if ($this->transaksi->status != 'kasir') {
            redirect()->to('admin/penjualan/produk');
        }
    }
    public function render()
    {
        return view('livewire.admin.penjualan-bayar-admin')->extends('layouts.main')->section('content');
    }

    public function sdh_byr_diterima()
    {
        $id = $this->transaksi->id;
        $transaksi = Transaksi::with('transaksiitem')->find($id);
        if ($transaksi->total_pembayaran > $this->diterima) {
            $this->emit('error', ['pesan' => 'nominal uang diterima tunai harus lebih besar dari tagihan pembayaran']);
        } else {
            $transaksi->update([
                'diterima' => $this->diterima,
                'kembalian' => $this->diterima - $transaksi->total_pembayaran,
                'status' => 'selesai',
                'islunas' => true
            ]);

            TransaksiLog::create([
                'transaksi_id' => $transaksi->id,
                'status' => 'selesai',
            ]);

            foreach ($transaksi->transaksiitem as $item) {

                // transaksiitem terjual true
                TransaksiItem::find($item->id)->update([
                    'terjual' => true
                ]);

                $produkstok = ProdukStok::where('produk_id', $item->produk_id)->first();
                if ($produkstok) {
                    $produkstok->update([
                        'real' => $produkstok->real - $item->qty,
                    ]);
                    ProdukStokLog::create([
                        'produk_stok_id' => $produkstok->id,
                        'jenis' => 'keluar',
                        'real' => $item->qty,
                        'keterangan' => 'diterima konsumen'
                    ]);
                }

            }

            $this->emit('success', ['pesan' => 'Berhasil']);
            redirect()->to('admin/penjualan/bayar/berhasil/' . $transaksi->no_transaksi);
        }
    }

    public function sdh_byr_kemas()
    {
        $id = $this->transaksi->id;
        $transaksi = Transaksi::with('transaksiitem')->find($id);
        if ($transaksi->total_pembayaran > $this->diterima) {
            $this->emit('error', ['pesan' => 'nominal uang diterima tunai harus lebih besar dari tagihan pembayaran']);
        } else {
            $transaksi->update([
                'diterima' => $this->diterima,
                'kembalian' => $this->diterima - $transaksi->total_pembayaran,
                'status' => 'sedang_dikemas',
                'islunas' => true
            ]);

            TransaksiLog::create([
                'transaksi_id' => $transaksi->id,
                'status' => 'sedang_dikemas',
            ]);

            // foreach ($transaksi->transaksiitem as $item) {
            //     // transaksiitem terjual true
            //     TransaksiItem::find($item->id)->update([
            //         'terjual' => true
            //     ]);
            // }

            $this->emit('success', ['pesan' => 'Berhasil']);
            redirect()->to('admin/penjualan/bayar/berhasil/' . $transaksi->no_transaksi);
        }
    }

    public function byr_nanti_diterima()
    {
        $id = $this->transaksi->id;
        $transaksi = Transaksi::with('transaksiitem')->find($id);

        $transaksi->update([

            'status' => 'diterima',
            'islunas' => false
        ]);

        TransaksiLog::create([
            'transaksi_id' => $transaksi->id,
            'status' => 'diterima',
        ]);

        foreach ($transaksi->transaksiitem as $item) {
            // TransaksiItem::find($item->id)->update([
            //     'terjual' => true
            // ]);

            $produkstok = ProdukStok::where('produk_id', $item->produk_id)->first();
            if ($produkstok) {
                $produkstok->update([
                    'real' => $produkstok->real - $item->qty,
                ]);

                ProdukStokLog::create([
                    'produk_stok_id' => $produkstok->id,
                    'jenis' => 'keluar',
                    'real' => $item->qty,
                    'keterangan' => 'diterima'
                ]);
            }
        }

        $this->emit('success', ['pesan' => 'Berhasil']);
        redirect()->to('admin/penjualan/bayar/berhasil/' . $transaksi->no_transaksi);
    }

    public function byr_nanti_kemas()
    {
        $id = $this->transaksi->id;
        $transaksi = Transaksi::with('transaksiitem')->find($id);

        $transaksi->update([

            'status' => 'sedang_dikemas',
            'islunas' => false
        ]);

        TransaksiLog::create([
            'transaksi_id' => $transaksi->id,
            'status' => 'sedang_dikemas',
        ]);

        // foreach ($transaksi->transaksiitem as $item) {
        //     // transaksiitem terjual true
        //     TransaksiItem::find($item->id)->update([
        //         'terjual' => false
        //     ]);
        // }

        $this->emit('success', ['pesan' => 'Berhasil']);
        redirect()->to('admin/penjualan/bayar/berhasil/' . $transaksi->no_transaksi);
    }

    public function  cek_admin()
    {
        redirect()->to('admin/penjualan/produk');
    }

    public function batal()
    {
        $id = $this->transaksi->id;
        $transaksi = Transaksi::with('transaksiitem')->find($id);

        foreach ($transaksi->transaksiitem as $item) {
            $produkstok = ProdukStok::where('produk_id', $item->produk_id)->first();

            if ($produkstok) {
                $produkstok->update([
                    'po' => $produkstok->po + $item->qty,
                ]);

                ProdukStokLog::create([
                    'produk_stok_id' => $produkstok->id,
                    'jenis' => 'keluar',
                    'po' => $item->qty,
                    'keterangan' => 'batal'
                ]);
            }
        }

        $transaksi->delete();

        $this->emit('success', ['pesan' => 'Berhasil batal dan hapus transaksi']);
        redirect()->to('admin/penjualan/produk');
    }
}
