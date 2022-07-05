<?php

namespace App\Http\Livewire\Admin;

use App\Models\Kasir;
use App\Models\KasirKas;
use App\Models\KasirKasJenis;
use App\Models\KasirKasKategori;
use Livewire\Component;

class KasirDetailAdmin extends Component
{
    public $kasir, $kasirkas, $jenis, $kategori = [];
    public $take = 10;
    public $formtransaksi = false;
    public $byid;

    public $kasmasuk, $kaskeluar;
    public $Dkasawal, $Dpenjualantunai, $Dtambahkas, $Dtarikkas, $Dkasakhir, $selisih;

    public $kasir_kas_jenis_id, $kasir_kas_kategori_id, $nominal, $keterangan;

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
        $this->kasir = Kasir::with('kasirkas')->where('isaktif', true)->find($this->byid);
        $this->kasirkas = KasirKas::where('kasir_id', $this->kasir->id)->take($this->take)->latest()->get();

        $this->jenis = KasirKasJenis::get();
        $kategori = KasirKasKategori::get();
        $this->kasmasuk = $this->kasir->kasirkas()->where('kasir_kas_jenis_id', $this->jenis->where('nama', 'masuk')->first()->id)->sum('nominal');
        $this->kaskeluar = $this->kasir->kasirkas()->where('kasir_kas_jenis_id', $this->jenis->where('nama', 'keluar')->first()->id)->sum('nominal');
        $this->Dkasawal =  $this->kasir->kasirkas()->where('kasir_kas_kategori_id', $kategori->where('nama', 'kas awal')->first()->id)->whereDate('created_at', '=', date('Y-m-d'))->sum('nominal');
        $this->Dpenjualantunai =  $this->kasir->kasirkas()->where('kasir_kas_kategori_id', $kategori->where('nama', 'penjualan tunai')->first()->id)->whereDate('created_at', '=', date('Y-m-d'))->sum('nominal');
        $this->Dtambahkas =  $this->kasir->kasirkas()->where('kasir_kas_kategori_id', $kategori->where('nama', 'tambah kas')->first()->id)->whereDate('created_at', '=', date('Y-m-d'))->sum('nominal');
        $this->Dtarikkas =  $this->kasir->kasirkas()->where('kasir_kas_kategori_id', $kategori->where('nama', 'tarik kas')->first()->id)->whereDate('created_at', '=', date('Y-m-d'))->sum('nominal');
        $this->Dkasakhir =  $this->kasir->kasirkas()->where('kasir_kas_kategori_id', $kategori->where('nama', 'kas akhir')->first()->id)->whereDate('created_at', '=', date('Y-m-d'))->sum('nominal');
        $this->selisih = $this->Dkasakhir == null ? 0 : $this->Dkasakhir - $this->kasir->kas;

        if ($this->kasir_kas_jenis_id) {
            $this->kategori = KasirKasKategori::where('kasir_kas_jenis_id', $this->kasir_kas_jenis_id)->where('istampil', true)->get();
        }

        return view('livewire.admin.kasir-detail-admin')->extends('layouts.main')->section('content');
    }

    public function buattransaksi()
    {
        $this->validate([
            'kasir_kas_jenis_id' => 'required',
            'kasir_kas_kategori_id' =>  'required',
            'nominal' => 'required',
            'keterangan' => 'nullable'
        ]);
        $kasir = Kasir::find($this->kasir->id);

        KasirKas::create([
            'kasir_id' => $kasir->id,
            'kasir_kas_jenis_id' => $this->kasir_kas_jenis_id,
            'kasir_kas_kategori_id' => $this->kasir_kas_kategori_id,
            'nominal' => $this->nominal,
            'keterangan' => $this->keterangan
        ]);

        $jenis = KasirKasJenis::find($this->kasir_kas_jenis_id);
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
