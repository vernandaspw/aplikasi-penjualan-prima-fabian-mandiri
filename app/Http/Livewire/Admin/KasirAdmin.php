<?php

namespace App\Http\Livewire\Admin;

use App\Models\Kasir;
use App\Models\KasirKas;
use App\Models\KasirKasJenis;
use App\Models\KasirKasKategori;
use App\Models\KasirTransaksi;
use App\Models\KasirTransaksiJenis;
use App\Models\KasirTransaksiKategori;
use Livewire\Component;

class KasirAdmin extends Component
{
    public $buatkasir = false;
    public $formedit = false;

    public $kasir = [];

    public $namabaru, $modalbaru;

    public $byid, $nama;

    public function render()
    {
        $this->kasir = Kasir::get();
        return view('livewire.admin.kasir-admin')->extends('layouts.main')->section('content');
    }

    public function ubahstatus($id)
    {
        $kasir = Kasir::find($id);
        if ($kasir->isaktif == true) {
            $aktif = false;
        }else {
            $aktif = true;
        }
        $kasir->update([
            'isaktif' => $aktif
        ]);

        if ($aktif == true) {
            $this->emit('success', ['pesan' => 'Berhasil aktifkan kasir']);
        }else {
            $this->emit('success', ['pesan' => 'Berhasil me non aktifkan kasir']);
        }
    }

    public function hapus($id)
    {
        $kasir = Kasir::find($id);
        $kasir->delete();
        $this->emit('success', ['pesan' => 'Berhasil hapus kasir']);
    }

    public function kasirbaru()
    {
        // dd($this->modalbaru);
        $this->validate([
            'namabaru' => 'required|max:25',
            'modalbaru' => '',
        ]);

        $masuk = KasirTransaksiJenis::where('nama', 'modal')->first();
        $kasawal = KasirTransaksiKategori::where('nama', 'modal awal')->first();

        $kasir = Kasir::create([
            'nama' => $this->namabaru,
            'modal' => $this->modalbaru == null ? 0 : $this->modalbaru
        ]);

        KasirTransaksi::create([
            'kasir_id' => $kasir->id,
            'kasir_transaksi_jenis_id' => $masuk->id,
            'kasir_transaksi_kategori_id' => $kasawal->id,
            'nominal' => $this->modalbaru == null ? 0 : $this->modalbaru
        ]);

        $this->emit('success', ['pesan' => 'Berhasil buat pesanan']);

        $this->namabaru = null;
        $this->modalbaru = null;
    }

    public function formedit($id)
    {
        $this->buatkasir = false;
        $this->formedit = true; 
        $kasir = Kasir::find($id);
        $this->byid = $id;
        $this->nama = $kasir->nama;
    }

    public function editkasir($id)
    {
        $this->validate([
            'namabaru' => 'max:25'
        ]);
        $kasir = Kasir::find($id);
        $kasir->update([
            'nama' => $this->nama
        ]);

        $this->emit('success', ['pesan' => 'Berhasil ubah data kasir']);
    }
    public function tutup()
    {
        $this->formedit = false;
        $this->byid = null;
        $this->nama = null;
    }

}
