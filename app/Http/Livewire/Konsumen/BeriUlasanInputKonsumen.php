<?php

namespace App\Http\Livewire\Konsumen;

use App\Models\ProdukUlasan;
use App\Models\TransaksiItem;
use Livewire\Component;

class BeriUlasanInputKonsumen extends Component
{
    public $data;

    public $byid;

    public $rating, $ulasan;

    public function mount($id)
    {
        $this->byid = $id;
        $this->data = TransaksiItem::find($id);
    }
    public function render()
    {
        return view('livewire.konsumen.beri-ulasan-input-konsumen')->extends('layouts.main')->section('content');
    }

    public function buat()
    {

        $transaksiitem = TransaksiItem::with('transaksi')->find($this->data->id);
        // dd($transaksiitem->transaksi->no_transaksi);
        $ulasan =  ProdukUlasan::create([
            'konsumen_id' => auth('konsumen')->user()->id,
            'produk_id' => $transaksiitem->produk_id,
            'rating' => $this->rating,
            'ulasan' => $this->ulasan
        ]);

        $transaksiitem->update([
            'produk_ulasan_id' => $ulasan->id
        ]);

        $this->emit('success', ['pesan' => 'Berhasil memberi rating']);

        redirect()->to('pesanan-detail/'. $transaksiitem->transaksi->no_transaksi);
    }
}
