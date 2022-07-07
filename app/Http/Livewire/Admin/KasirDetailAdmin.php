<?php

namespace App\Http\Livewire\Admin;

use App\Models\Kasir;
use App\Models\KasirKas;
use App\Models\KasirKasJenis;
use App\Models\KasirKasKategori;
use App\Models\KasirTransaksi;
use App\Models\KasirTransaksiJenis;
use App\Models\KasirTransaksiKategori;
use App\Models\MetodePembayaran;
use Livewire\Component;

class KasirDetailAdmin extends Component
{
    public $kasir, $kasirtransaksi, $jenis, $kategori = [];
    public $take = 10;
    public $formtransaksi = false;
    public $byid;

    public $kasmasuk, $kaskeluar, $start, $end;
    public $Dmodalawal, $Dpenjualantunai, $Dtambahkas, $Dtarikkas, $Dmodalakhir, $selisih;
public $paymentcash;

    public $kasir_transaksi_jenis_id, $kasir_transaksi_kategori_id, $nominal, $keterangan;

    public function lanjut()
    {
        $this->take = $this->take + 10;
    }

    public function mount($id)
    {
        $this->byid = $id;
    }

    public function render()
    {
        $this->kasir = Kasir::with('kasirtransaksi')->where('isaktif', true)->find($this->byid);
        $this->kasirtransaksi = KasirTransaksi::with('jenis', 'kategori','transaksi')->where('kasir_id', $this->kasir->id)->take($this->take)->latest()->get();

        $this->jenis = KasirTransaksiJenis::get();
        $kategori = KasirTransaksiKategori::get();

        $this->start =  $this->kasir->kasirtransaksi()->where('kasir_transaksi_kategori_id', $kategori->where('nama', 'modal awal')->first()->id)->whereDate('created_at', '=', date('Y-m-d'))->first();
        $this->end =  $this->kasir->kasirtransaksi()->where('kasir_transaksi_kategori_id', $kategori->where('nama', 'modal akhir')->first()->id)->whereDate('created_at', '=', date('Y-m-d'))->first();

        $this->Dmodalawal =  $this->kasir->kasirtransaksi()->where('kasir_transaksi_kategori_id', $kategori->where('nama', 'modal awal')->first()->id)->whereDate('created_at', '=', date('Y-m-d'))->sum('nominal');
        $this->Dmodalakhir =  $this->kasir->kasirtransaksi()->where('kasir_transaksi_kategori_id', $kategori->where('nama', 'modal akhir')->first()->id)->whereDate('created_at', '=', date('Y-m-d'))->sum('nominal');

        $this->selisih = $this->Dmodalakhir == null ? 0 : $this->Dmodalakhir - $this->kasir->modal;
        
        $this->Dpenjualantunai =  $this->kasir->kasirtransaksi()->where('kasir_transaksi_kategori_id', $kategori->where('nama', 'penjualan')->first()->id)->whereDate('created_at', '=', date('Y-m-d'))->sum('nominal');
        
        $metodepembayaran = MetodePembayaran::where('metode','tunai')->first();
        $this->paymentcash = $this->kasirtransaksi->transaksi;
        
        // $this->kasirtransaksi->transaksi->where('metode_pembayaran_id', $metodepembayaran->id)->get();

        // $this->Dtambahkas =  $this->kasir->kasirtransaksi()->where('kasir_transaksi_kategori_id', $kategori->where('nama', 'tambah kas')->first()->id)->whereDate('created_at', '=', date('Y-m-d'))->sum('nominal');
        // $this->Dtarikkas =  $this->kasir->kasirtransaksi()->where('kasir_transaksi_kategori_id', $kategori->where('nama', 'tarik kas')->first()->id)->whereDate('created_at', '=', date('Y-m-d'))->sum('nominal');
       
        

        if ($this->kasir_transaksi_jenis_id) {
            $this->kategori = kasirtransaksiKategori::where('kasir_transaksi_jenis_id', $this->kasir_transaksi_jenis_id)->where('istampil', true)->get();
        }

        return view('livewire.admin.kasir-detail-admin')->extends('layouts.main')->section('content');
    }

    public function buattransaksi()
    {
        $this->validate([
            'kasir_transaksi_jenis_id' => 'required',
            'kasir_transaksi_kategori_id' =>  'required',
            'nominal' => 'required',
            'keterangan' => 'nullable'
        ]);
        $kasir = Kasir::find($this->kasir->id);

        kasirtransaksi::create([
            'kasir_id' => $kasir->id,
            'kasir_transaksi_jenis_id' => $this->kasir_transaksi_jenis_id,
            'kasir_transaksi_kategori_id' => $this->kasir_transaksi_kategori_id,
            'nominal' => $this->nominal,
            'keterangan' => $this->keterangan
        ]);

        $jenis = kasirtransaksiJenis::find($this->kasir_transaksi_jenis_id);
        if ($jenis->nama == 'masuk') {
            $kas = $kasir->kas + $this->nominal;
        } elseif ($jenis->nama == 'keluar') {
            $kas = $kasir->kas - $this->nominal;
        } elseif ($jenis->nama == 'tutup') {
            $kas = $kasir->kas;
        }
        $kasir->update([
            'kas' => $kas
        ]);
    }
}
