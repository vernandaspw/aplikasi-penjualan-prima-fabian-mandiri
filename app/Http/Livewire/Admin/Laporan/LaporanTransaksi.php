<?php

namespace App\Http\Livewire\Admin\Laporan;

use App\Exports\LaporanPenjualanExport;
use App\Exports\LaporanTransaksiExport;
use App\Models\MetodeKirim;
use App\Models\MetodePembayaran;
use App\Models\Transaksi;
use App\Models\TransaksiJenis;
use App\Models\TransaksiKategori;
use Barryvdh\DomPDF\Facade\Pdf;
use Livewire\Component;

class LaporanTransaksi extends Component
{
    public $transaksi = [];
    public $jenis, $kategori, $pengiriman, $pembayaran;
    public $take = 20;
    public $jml_item;
    public $selectJenis, $selectKategori, $selectPengiriman, $selectPembayaran;

    public $cari_no;

    public $start_date, $end_date;

    public function lanjut()
    {
        $this->take = $this->take + 10;
    }

    public function mount()
    {
        $this->jenis = TransaksiJenis::latest()->get();
        // $this->kategori = TransaksiKategori::latest()->get();
        $this->pengiriman = MetodeKirim::where('isaktif', true)->get();
        $this->pembayaran = MetodePembayaran::where('isaktif', true)->get();
    }

    public function render()
    {
        $transaksi = Transaksi::with('konsumen','transaksi_kategori', 'transaksi_jenis', 'metodekirim', 'metodepembayaran');
        if ($this->cari_no) {
            $transaksi->where('no_transaksi', 'like', '%'. $this->cari_no . '%');
        }

        if ($this->selectJenis) {
            // dd($this->selectJenis);
            $transaksi->where('transaksi_jenis_id', $this->selectJenis);
            if ($this->selectKategori) {
                $transaksi->where('transaksi_kategori_id', $this->selectKategori);
            }
        }
        if ($this->selectPengiriman) {
            $transaksi->where('metode_kirim_id', $this->selectPengiriman);
        } 
        if ($this->selectPembayaran) {
            $transaksi->where('metode_pembayaran_id', $this->selectPembayaran);
        }
        if ($this->start_date && $this->end_date) {
            $transaksi->whereBetween('created_at', [$this->start_date, $this->end_date]);
            $this->take = $this->jml_item;
        }

        $this->transaksi = $transaksi->take($this->take)->latest()->get();

        $this->jml_item = Transaksi::with('konsumen', 'transaksi_kategori', 'transaksi_jenis', 'metodekirim', 'metodepembayaran')->count();
        return view('livewire.admin.laporan.laporan-transaksi')->extends('layouts.main')->section('content');
    }

    public function cetak_laporan()
    {
        $datas = Transaksi::with('transaksiitem', 'pegawai', 'konsumen', 'metodekirim', 'metodepembayaran')->whereBetween('created_at', [$this->start_date, $this->end_date])->get();

        $start = $this->start_date;
        $end = $this->end_date;

        if ($datas->count() == 0) {
            $this->emit('error', ['pesan' => 'Tidak ada data, masukan terlebih dahulu tanggal yang akan dicetak']);
        } else {
            if ($start < $end) {
                $pdf = Pdf::loadView('Exports.laporan-transaksi', compact('datas', 'start', 'end'))->setPaper('a4', 'portrait')->output();
                return response()->streamDownload(
                    fn () => print($pdf),
                    'laporan-transaksi-' . now() . '.pdf'
                );
            } else {
                $this->emit('error', ['pesan' => 'Tanggal awal harus lebih lama daripada tanggal akhir']);
            }
        }
    }

    public function downloadExcel()
    {
        $start = $this->start_date;
        $end = $this->end_date;
        $data = Transaksi::with('transaksiitem', 'pegawai', 'konsumen', 'metodekirim', 'metodepembayaran')->whereBetween('created_at', [$this->start_date, $this->end_date])->get();
        if ($start == null && $end == null) {
            $this->emit('error', ['pesan' => 'Tidak ada data, masukan terlebih dahulu tanggal yang akan dicetak']);
        } else {
            if ($start < $end) {
                return (new LaporanTransaksiExport($data, $start, $end))->download('laporan-transaksi-' . now() . '.xlsx');
            } else {
                $this->emit('error', ['pesan' => 'Tanggal awal harus lebih lama daripada tanggal akhir']);
            }
        }
    }
}
