<?php

namespace App\Http\Livewire\Admin;

use App\Models\KeranjangItem;
use App\Models\Pegawai;
use App\Models\Produk;
use App\Models\ProdukKategori;
use App\Models\TransaksiItem;
use Livewire\Component;

class PenjualanManualAdmin extends Component
{

    public $nama_produk;
    public $qty = 1;
    public $harga_jual, $harga_modal, $berat;

    public function render()
    {
        return view('livewire.admin.penjualan-manual-admin')->extends('layouts.main')->section('content');
    }

    public function tambahproduk()
    {
        $pegawai = Pegawai::with('keranjang')->find(auth('pegawai')->user()->id);

        $harga_modal = $this->harga_modal == null ? 0 : $this->harga_modal;
        $berat = $this->berat == null ? 0 : $this->berat;


        $totalharga =  $this->harga_jual * $this->qty;
        $totalmodal =  $harga_modal * $this->qty;
        $totalberat =  $berat * $this->qty;

        $cartitem = KeranjangItem::create([
            'pegawai_id' => auth('pegawai')->user()->id,
            'keranjang_id' => $pegawai->keranjang->id,
            'nama_produk' => $this->nama_produk,
            'qty' => $this->qty,
            'harga_jual' => $this->harga_jual,
            'harga_modal' => $harga_modal,
            'berat' => $berat,
            'total_harga' => $totalharga,
            'total_modal' => $totalmodal,
            'total_berat' => $totalberat

        ]);

        $this->nama_produk = null;
        $this->qty = 1;
        $this->harga_jual = null;
        $this->harga_modal = null;
        $this->berat = null;

        $this->emit('refresh');
        $this->emit('success', ['pesan' => 'berhasil tambah produk ke keranjang']);
    }
}
