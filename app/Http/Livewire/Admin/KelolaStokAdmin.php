<?php

namespace App\Http\Livewire\Admin;

use App\Models\ProdukStok;
use App\Models\ProdukStokLog;
use Livewire\Component;

class KelolaStokAdmin extends Component
{
    public $produkstok;
    public $cariproduk;

    public $take = 10;
    public $jmlprodukstok;

    public $tambahstok, $kurangstok;

    public $inputtambahreal, $inputtambahpo, $inputkurangpo, $inputkurangreal;

    public $tambahpage = false, $kurangpage = false;

     public function lanjut()
    {
        $this->take = $this->take + 10;
    }

    public function render()
    {
        $stok = ProdukStok::with('produk')->latest();
        if ($this->cariproduk) {
            $stok->with(['produk' => function($q){
                $q->where('produks.nama', $this->cariproduk);
            }]);

            // $stok->where('nama', $this->cariproduk)->orWhere('barcode', $this->cariproduk);
        }
        $this->produkstok = $stok->get();

        $this->jmlprodukstok = $stok->count();
        return view('livewire.admin.kelola-stok-admin')->extends('layouts.main')->section('content');
    }

    public function formtambah($id)
    {
        $this->tambahpage = true;
        $this->kurangpage = false;
        $this->tambahstok = ProdukStok::with('produk')->find($id);
    }

    public function tambahstokproduk($id)
    {
        if ($this->inputtambahpo < 0 || $this->inputtambahreal < 0) {
            $this->emit('error', ['pesan' => 'tidak boleh minus']);
        } else {
            $buat = ProdukStok::find($id);

            $cek = $buat->update([
                'po' => $buat->po + $this->inputtambahpo,
                'real' => $buat->real + $this->inputtambahreal
            ]);

            if ($cek) {
                ProdukStokLog::create([
                    'produk_stok_id' => $buat->id,
                    'jenis' => 'masuk',
                    'po' => $this->inputtambahpo,
                    'real' =>  $this->inputtambahreal,
                    'keterangan' => 'tambah stok produk'
                ]);
            }

            $this->emit('success', ['pesan' => 'Berhasil tambah stok produk']);
        }
    }

    public function formkurang($id)
    {
        $this->kurangpage = true;
        $this->tambahpage = false;
        $this->kurangstok = ProdukStok::with('produk')->find($id);
    }

    public function kurangstokproduk($id)
    {
        if ($this->inputkurangpo < 0 || $this->inputkurangreal < 0) {
            $this->emit('error', ['pesan' => 'tidak boleh minus']);
        } else {
            $buat = ProdukStok::find($id);

            $cek = $buat->update([
                'po' => $buat->po - $this->inputkurangpo,
                'real' => $buat->real - $this->inputkurangreal
            ]);

            if ($cek) {
                ProdukStokLog::create([
                    'produk_stok_id' => $buat->id,
                    'jenis' => 'keluar',
                    'po' => $this->inputkurangpo,
                    'real' =>  $this->inputkurangreal,
                    'keterangan' => 'kurang stok produk'
                ]);
            }

            $this->emit('success', ['pesan' => 'Berhasil kurang stok produk']);
        }
    }
}
