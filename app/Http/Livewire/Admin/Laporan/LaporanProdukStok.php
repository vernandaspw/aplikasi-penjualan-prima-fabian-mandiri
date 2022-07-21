<?php

namespace App\Http\Livewire\Admin\Laporan;

use App\Exports\LaporanProdukStokExport;
use App\Models\ProdukStok;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;

class LaporanProdukStok extends Component
{
    public $produkstok = [];
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
        $produkstok = ProdukStok::with('produk');
        // if ($this->cariproduk) {
        //     $this->produk = $produk->where('nama', 'LIKE', '%' . $this->cariproduk . '%')->orWhere('barcode', 'like', '%' . $this->cariproduk . '%')->latest()->take($this->take)->get();
        // }
        // if ($this->start_date && $this->end_date) {
        //     $produk->whereBetween('created_at', [$this->start_date, $this->end_date]);
        //     $this->take = $this->jml_item;
        // }

        $this->produkstok = $produkstok->latest()->take($this->take)->get();
        // dd($this->produk);

        // $this->jmlkategori = ProdukKategori::get()->count();
        // $this->jmlmerek = ProdukMerek::get()->count();

        // $this->kategori = ProdukKategori::latest()->get();
        // $this->merek = ProdukMerek::latest()->get();

        $this->jml_item = ProdukStok::get()->count();
        return view('livewire.admin.laporan.laporan-produk-stok')->extends('layouts.main')->section('content');
    }

    public function cetak_laporan()
    {
        $datas =  ProdukStok::with('produk')->get();
        if ($datas->count() == 0) {
            $this->emit('error', ['pesan' => 'Tidak ada data, masukan terlebih dahulu tanggal yang akan dicetak']);
        } else {
            $pdf = Pdf::loadView('Exports.laporan-produk-stok', compact('datas'))->setPaper('a4', 'portrait')->output();
            return response()->streamDownload(
                fn () => print($pdf),
                'laporan-produk-stok' . now() . '.pdf'
            );
        }
    }

    public function downloadExcel()
    {
        $datas =  ProdukStok::with('produk')->get();
        if ($datas == null) {
            $this->emit('error', ['pesan' => 'Tidak ada data, masukan terlebih dahulu tanggal yang akan dicetak']);
        } else {
            return (new LaporanProdukStokExport($datas))->download('laporan-produk-' . now() . '.xlsx');
        }
    }

}
