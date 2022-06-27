<?php

namespace App\Http\Livewire\Admin;

use App\Models\Pengaturan;
use Livewire\Component;

class KelolaPengaturanAdmin extends Component
{

    public $nm_perusahaan, $no_telp, $no_wa, $ig, $sejarah, $visi, $misi, $provinsi, $kota, $kecamatan, $alamat, $kodepos;

    public $textarea_sejarah, $textarea_visi, $textarea_misi;

    public $pengaturan = [];



    public function mount()
    {
        $this->pengaturan = Pengaturan::first();

        $this->nm_perusahaan = $this->pengaturan->nm_perusahaan;
        $this->no_telp = $this->pengaturan->no_telp;
        $this->no_wa = $this->pengaturan->no_wa;
        $this->ig = $this->pengaturan->ig;
        $this->sejarah = $this->pengaturan->sejarah;
        $this->visi = $this->pengaturan->visi;
        $this->misi = $this->pengaturan->misi;
        $this->provinsi = $this->pengaturan->provinsi;
        $this->kota = $this->pengaturan->kota;
        $this->kecamatan = $this->pengaturan->kecamatan;
        $this->alamat = $this->pengaturan->alamat;
        $this->kodepos = $this->pengaturan->kodepos;
    }

    public function render()
    {
        return view('livewire.admin.kelola-pengaturan-admin')->extends('layouts.main')->section('content');
    }


    public function simpan($id)
    {
        $this->validate([
            'nm_perusahaan' => 'max:40',
            'no_telp' => 'max:15',
            'no_wa' => 'max:15',
            'ig' => 'max:30',
            'provinsi' => 'max:30',
            'kota' => 'max:30',
            'kecamatan' => 'max:30',
            'kodepos' => 'max:7'
        ]);
        // dd($this->textarea_sejarah);

        $d  = Pengaturan::find($id);
        $cek = $d->update([
            'nm_perusahaan' => $this->nm_perusahaan,
            'no_telp' => $this->no_telp,
            'no_wa' => $this->no_wa,
            'ig' => $this->ig,
            'sejarah' => $this->sejarah,
            'visi' => $this->visi,
            'misi' => $this->misi,
            'provinsi' => $this->provinsi,
            'kota' => $this->kota,
            'alamat' => $this->alamat,
            'kodepos' => $this->kodepos
        ]);

        $this->emit('success', ['pesan' => 'berhasil ubah data']);


    }


}
