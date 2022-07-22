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
    public $jenis = [], $kategori = [], $metodepembayarans = [];
    public $take = 10;
    public $jml_item;
    public $selectJenis, $selectKategori;

    public $cekJenis;
    public $inputJenis, $inputKategori, $nominal, $catatan, $datetime, $metodepembayaran, $nama, $no_telp;
    public $modal = 0;
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

            $this->cekJenis = TransaksiJenis::find($this->inputJenis);
    
        }

        $this->metodepembayarans = MetodePembayaran::where('isaktif', true)->latest()->get();

        $transaksi = Transaksi::with('konsumen', 'transaksi_kategori', 'transaksi_jenis', 'metodekirim', 'metodepembayaran');
        
        if ($this->cari_no) {
            $transaksi->where('no_transaksi', 'like', '%' . $this->cari_no . '%');
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

    public function terima_pembayaran($id)
    {
        $transaksi =  Transaksi::with('konsumen', 'transaksi_kategori', 'transaksi_jenis', 'metodekirim', 'metodepembayaran')->find($id);

        $transaksi->update([
            'status' => 'sedang_dikemas',
            'islunas' => true
        ]);

        TransaksiLog::create([
            'transaksi_id' => $id,
            'status' => 'sedang_dikemas',
        ]);

        $this->emit('success', ['pesan' => 'Berhasil terima pembayaran']);
    }

    public function formBuat()
    {
        $this->pageBuat = true;
    }

    public function buatTransaksi()
    {
        $this->validate([
            'nominal' => 'min:1|required'
        ]);

         $make_no = 'T' . date('Y') . date('m') . date('d') . date('H') . rand(10, 99) . rand(10, 99);

        try {
            $buat = Transaksi::create([
               'no_transaksi' => $make_no,
                'pegawai_id' => auth('pegawai')->user()->id,
                'transaksi_jenis_id' => $this->inputJenis,
                'transaksi_kategori_id' => $this->inputKategori,
                'total_pembayaran' => $this->nominal,
                'total_modal' => $this->modal,
                'catatan' => $this->catatan,
                'created_at' => $this->datetime,
                'islunas' => $this->islunas,
                'metode_pembayaran_id' => $this->metodepembayaran,
                'nama_konsumen' => $this->nama,
                'nowa_konsumen' => $this->no_telp,
                'status' => 'selesai'
            ]);
            // dd($buat);
            if ($buat) {
                TransaksiLog::create([
                    'transaksi_id' => $buat->id,
                    'status' => 'selesai'
                ]);
            }

        } catch (\Exception $e) {
            dd($e);
            return $this->emit('error', ['pesan' => 'Terjadi kesalahan']);
        }

        $this->emit('success', ['pesan' => 'berhasil buat transaksi']);
    }

    public function hapus($id)
    {
        $hapus = Transaksi::find($id)->delete();
    }
}
