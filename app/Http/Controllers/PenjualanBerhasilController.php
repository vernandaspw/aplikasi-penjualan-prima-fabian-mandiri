<?php

namespace App\Http\Controllers;

use App\Models\Transaksi;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;


class PenjualanBerhasilController extends Controller
{
    public function get($id)
    {
        $data = Transaksi::with('transaksiitem', 'pegawai', 'konsumen', 'metodekirim', 'metodepembayaran')->where('no_transaksi', $id)->first();

        return view('Exports.penjualan_berhasil', compact('data'));
    }

    public function cetakstruk($id)
    {
        $data = Transaksi::with('transaksiitem', 'pegawai', 'konsumen', 'metodekirim', 'metodepembayaran')->where('no_transaksi', $id)->first();
        $pdf = Pdf::loadView('Exports.struk', compact('data'))->setPaper('a4', 'portrait');
        return $pdf->stream();
    }
    public function cetaknota($id)
    {
        $data = Transaksi::with('transaksiitem', 'pegawai', 'konsumen', 'metodekirim', 'metodepembayaran')->where('no_transaksi', $id)->first();
        $pdf = Pdf::loadView('Exports.nota', compact('data'))->setPaper('a4', 'portrait');
        return $pdf->stream();
    }
    public function cetaksuratjalan($id)
    {
        $data = Transaksi::with('transaksiitem', 'pegawai', 'konsumen', 'metodekirim', 'metodepembayaran')->where('no_transaksi', $id)->first();
        $pdf = Pdf::loadView('Exports.surat-jalan', compact('data'))->setPaper('a4', 'portrait');
        return $pdf->stream('surat-jalan');
    }
}
