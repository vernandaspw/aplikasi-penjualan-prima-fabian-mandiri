<?php

namespace App\Http\Livewire\Konsumen;

use App\Models\MetodeKirim;
use App\Models\MetodeKirimPembayaran;
use App\Models\MetodePembayaran;
use Livewire\Component;

class CheckoutKonsumen extends Component
{
    public $alamat;
    public $pengiriman, $pembayaran = [];

    public $metode_pengiriman_id, $metode_pembayaran_id;


    public function render()
    {
        $this->alamat = auth('konsumen')->user();

        $this->pengiriman = MetodeKirim::with('metode_pembayaran')->where('isaktif', true)->get();

        if ($this->metode_pengiriman_id) {
            $kirim =  MetodeKirim::with('metode_pembayaran')->find($this->metode_pengiriman_id);
            $this->pembayaran = $kirim->metode_pembayaran->where('isaktif', true);
        }

        return view('livewire.konsumen.checkout-konsumen')->extends('layouts.main')->section('content');
    }
}
