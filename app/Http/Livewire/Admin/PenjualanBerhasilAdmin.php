<?php

namespace App\Http\Livewire\Admin;

use App\Models\Transaksi;
use Livewire\Component;

use PDF;

class PenjualanBerhasilAdmin extends Component
{

    public $byid;
    public $data;

    public function mount($id)
    {
        $this->byid = $id;
    }

    public function render()
    {
        $this->data = Transaksi::with('metodekirim', 'metodepembayaran')->where('no_transaksi', $this->byid)->first();
        return view('livewire.admin.penjualan-berhasil-admin')->extends('layouts.main')->section('content');
    }

    public function cetak_struk()
    {
        $data = Transaksi::with('metodekirim', 'metodepembayaran')->where('no_transaksi', $this->byid)->first();

        $view = view('Exports.struk')->with(compact('data'));
        $html = $view->render();

        PDF::loadHTML($html)->save(public_path() . '/order.pdf');

        // $pdf = PDF::loadView('Exports.struk')->setOptions(['defaultFont' => 'sans-serif']);
        $pdf = PDF::loadView('Exports.struk', compact('data'))->setPaper('a4', 'portrait')->output();

        return response()->streamDownload(

            fn () => print($pdf->stream('ss.pdf')),
            "data_labs.pdf"
        );
    }

}
