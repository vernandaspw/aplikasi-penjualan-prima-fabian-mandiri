<?php

namespace App\Http\Livewire\Admin\Laporan;

use App\Exports\LaporanProdukExport;
use App\Models\Produk;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;

class LaporanProduk extends Component
{
    public $produk = [];
    public $jenis, $kategori;
    public $take = 20;
    public $jml_item;
    public $selectJenis, $selectKategori;

    public $cari_no;

    public $start_date, $end_date;

    public function lanjut()
    {
        $this->take = $this->take + 10;
    }

    public function render()
    {
        $produk = Produk::with('kategori', 'merek', 'gambar');
        // if ($this->cariproduk) {
        //     $this->produk = $produk->where('nama', 'LIKE', '%' . $this->cariproduk . '%')->orWhere('barcode', 'like', '%' . $this->cariproduk . '%')->latest()->take($this->take)->get();
        // }
        // if ($this->start_date && $this->end_date) {
        //     $produk->whereBetween('created_at', [$this->start_date, $this->end_date]);
        //     $this->take = $this->jml_item;
        // }

        $this->produk = $produk->latest()->take($this->take)->get();
        // dd($this->produk);

        // $this->jmlkategori = ProdukKategori::get()->count();
        // $this->jmlmerek = ProdukMerek::get()->count();

        // $this->kategori = ProdukKategori::latest()->get();
        // $this->merek = ProdukMerek::latest()->get();

        $this->jml_item = Produk::get()->count();
        return view('livewire.admin.laporan.laporan-produk')->extends('layouts.main')->section('content');
    }

    public function cetak_laporan()
    {
        $datas =  Produk::with('kategori', 'merek', 'gambar')->get();
        if ($datas->count() == 0) {
            $this->emit('error', ['pesan' => 'Tidak ada data, masukan terlebih dahulu tanggal yang akan dicetak']);
        } else {
            $pdf = Pdf::loadView('Exports.laporan-produk', compact('datas'))->setPaper('a4', 'portrait')->output();

            return response()->streamDownload(
                fn () => print($pdf),
                'laporan-produk-' . now() . '.pdf'
            );
        }
    }

    public function downloadExcel()
    {
        $datas =  Produk::with('kategori', 'merek', 'gambar')->get();
        if ($datas == null) {
            $this->emit('error', ['pesan' => 'Tidak ada data, masukan terlebih dahulu tanggal yang akan dicetak']);
        } else {
            return (new LaporanProdukExport($datas))->download('laporan-produk-' . now() . '.xlsx');
        }
    }
}
