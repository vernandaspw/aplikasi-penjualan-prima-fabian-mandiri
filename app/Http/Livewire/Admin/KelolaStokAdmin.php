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
        $this->produkstok = $stok->take($this->take)->get();

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

        $tambahpo = $this->inputtambahpo == null ? 0 : $this->inputtambahpo;
        $tambahreal = $this->inputtambahreal == null ? 0 : $this->inputtambahreal;

        if ($tambahpo < 0 || $tambahreal < 0) {
            $this->emit('error', ['pesan' => 'tidak boleh minus']);
        } else {
            $buat = ProdukStok::find($id);

            $cek = $buat->update([
                'po' => $buat->po +  $tambahpo,
                'real' => $buat->real +  $tambahreal
            ]);

            if ($cek) {
                ProdukStokLog::create([
                    'produk_stok_id' => $buat->id,
                    'jenis' => 'masuk',
                    'po' =>  $tambahpo,
                    'real' =>  $tambahreal,
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
        $kurangpo = $this->inputkurangpo == null ? 0 : $this->inputkurangpo;
        $kurangreal = $this->inputkurangreal == null ? 0 : $this->inputkurangreal;
        if ($kurangpo < 0 ||  $kurangreal < 0) {
            $this->emit('error', ['pesan' => 'tidak boleh minus']);
        } else {
            $buat = ProdukStok::find($id);

            $cek = $buat->update([
                'po' => $buat->po - $kurangpo,
                'real' => $buat->real -  $kurangreal
            ]);

            if ($cek) {
                ProdukStokLog::create([
                    'produk_stok_id' => $buat->id,
                    'jenis' => 'keluar',
                    'po' => $kurangpo,
                    'real' => $kurangreal,
                    'keterangan' => 'kurang stok produk'
                ]);
            }

            $this->emit('success', ['pesan' => 'Berhasil kurang stok produk']);
        }
    }
}
