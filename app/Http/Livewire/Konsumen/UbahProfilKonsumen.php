<?php

namespace App\Http\Livewire\Konsumen;

use App\Models\Konsumen;
use Livewire\Component;

class UbahProfilKonsumen extends Component
{
    public $konsumen = [];

    public $nama, $nohp, $email, $jeniskelamin, $wilayah;

public function mount()
{
    $konsumen = Konsumen::find(auth('konsumen')->user()->id);

    $this->nama = $konsumen->nama;
    $this->nohp = $konsumen->nohp;
    $this->email = $konsumen->email;
    $this->jeniskelamin = $konsumen->jeniskelamin;
    $this->wilayah = $konsumen->wilayah;
}

    public function render()
    {


        return view('livewire.konsumen.ubah-profil-konsumen')->extends('layouts.main')->section('content');
    }

    public function ubah()
    {
        $this->validate([
            'nama' => 'nullable|max:25',
            'nohp' =>   'nullable|max:25|unique:konsumens,nohp,' .auth('konsumen')->user()->id,
            'email' => 'email|unique:konsumens,email,'.auth('konsumen')->user()->id,
            'jeniskelamin' => '',
            'wilayah' => 'max:30|nullable'
        ]);

        $update = Konsumen::find(auth('konsumen')->user()->id)->update([
            'nama' => $this->nama,
            'nohp' => $this->nohp,
            'email' => $this->email,
            'jeniskelamin' => $this->jeniskelamin,
            'wilayah' => $this->wilayah
        ]);

        $this->emit('success', ['pesan' => 'Berhasil ubah profil']);
    }
}
