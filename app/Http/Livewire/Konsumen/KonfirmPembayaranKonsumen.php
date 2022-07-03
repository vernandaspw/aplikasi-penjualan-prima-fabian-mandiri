<?php

namespace App\Http\Livewire\Konsumen;

use App\Models\Transaksi;
use App\Models\TransaksiLog;
use Livewire\Component;

class KonfirmPembayaranKonsumen extends Component
{
    public $transaksi = [];
    public function mount($no)
    {
        $this->transaksi = Transaksi::with('konsumen','transaksiitem', 'metodekirim', 'metodepembayaran')->where('no_transaksi', $no)->where('konsumen_id', auth('konsumen')->user()->id)->first();

    }
    public function render()
    {
        return view('livewire.konsumen.konfirm-pembayaran-konsumen')->extends('layouts.main')->section('content');
    }

    public function konfirm($id)
    {
        $data = Transaksi::find($id);
        $data->update([
            'status' => 'proses_pembayaran'
        ]);

        TransaksiLog::create([
            'transaksi_id' => $id,
            'status' => 'proses_pembayaran'
        ]);

        $this->emit('success', ['pesan' => 'Berhasil konfirm pembayaran, pembayaran akan diproses admin']);
        redirect()->to('pesanan-detail/'. $data->no_transaksi);
    }
}
