<?php

namespace App\Http\Livewire\Konsumen;

use App\Models\ProdukStok;
use App\Models\ProdukStokLog;
use App\Models\Transaksi;
use App\Models\TransaksiLog;
use Livewire\Component;

class KonfirmPembayaranKonsumen extends Component
{
    public $transaksi = [];
    public function mount($no)
    {
        $this->transaksi = Transaksi::with('konsumen','transaksiitem', 'metodekirim', 'metodepembayaran')->where('no_transaksi', $no)->where('konsumen_id', auth('konsumen')->user()->id)->first();

        if ($this->transaksi->status == 'konfirm') {
            if (now() > $this->transaksi->pembayaran_expired_at) {
                $data = Transaksi::with('transaksiitem')->find($this->transaksi->id);
                $data->update([
                    'status' => 'gagal'
                ]);

                TransaksiLog::create([
                    'transaksi_id' => $data->id,
                    'status' => 'gagal',
                    'keterangan' => 'waktu pembayaran telah habis'
                ]);

                foreach ($data->transaksiitem as $item) {
                    $produkstok = ProdukStok::where('produk_id', $item->produk_id)->first();
                    $produkstok->update([
                        'po' => $produkstok->po + $item->qty,
                    ]);
                    ProdukStokLog::create([
                        'produk_stok_id' => $produkstok->id,
                        'jenis' => 'masuk',
                        'po' => $produkstok->po + $item->qty,
                        'keterangan' => 'gagal bayar'
                    ]);

                }

            }
        }
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
