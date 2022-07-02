<?php

namespace App\Http\Livewire\Konsumen;

use App\Models\Konsumen;
use Livewire\Component;

class UbahAlamatKonsumen extends Component
{
    public $konsumen = [];

    public $nama, $nohp, $email, $jeniskelamin, $wilayah;

    public function mount()
    {
        $konsumen = Konsumen::find(auth('konsumen')->user()->id);

        $this->provinsi = $konsumen->provinsi;
        $this->kota = $konsumen->kota;
        $this->kecamatan = $konsumen->kecamatan;
        $this->alamat = $konsumen->alamat;
        $this->patokan = $konsumen->patokan;
        $this->kodepos = $konsumen->kodepos;
    }
    public function render()
    {
        return view('livewire.konsumen.ubah-alamat-konsumen')->extends('layouts.main')->section('content');
    }

    public function ubah()
    {
        $this->validate([
            'provinsi' => 'nullable|max:30',
            'kota' => 'nullable|max:30',
            'kecamatan' => 'nullable|max:30',
            'alamat' => 'nullable',
            'patokan' => 'nullable',
            'kodepos' => 'nullable|max:7'

        ]);

        $update = Konsumen::find(auth('konsumen')->user()->id)->update([
            'provinsi' => $this->provinsi,
            'kota' => $this->kota,
            'kecamatan' => $this->kecamatan,
            'alamat' => $this->alamat,
            'patokan' => $this->patokan,
            'kodepos' => $this->kodepos
        ]);

        $this->emit('success', ['pesan' => 'Berhasil ubah alamat']);
    }
}
