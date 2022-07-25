<?php

namespace App\Http\Livewire\Admin;

use App\Models\ProdukMerek;
use Livewire\Component;

class KelolaProdukMerekAdmin extends Component
{
    public $produkmerek = [];

    public $take = 20;
    public $pagebuat = false, $pageedit = false, $jml_item;

    public $cari;

    public $byid, $nama;

    public function lanjut()
    {
        $this->take = $this->take + 10;
    }

    public function tutup()
    {
        if ($this->pagebuat == true) {
            $this->pagebuat = false;
        }

        if ($this->pageedit == true) {
            $this->pageedit = false;
        }

        $this->byid = null;
        $this->nama = null;
    }

    public function render()
    {
        $produkmerek = ProdukMerek::take($this->take);

        if ($this->cari) {
            $produkmerek->where('nama', 'LIKE', '%' . $this->cari . '%');
        }
        $this->produkmerek = $produkmerek->latest()->get();

        $this->jmlm_item = ProdukMerek::take($this->take)->latest()->get()->count();
        return view('livewire.admin.kelola-produk-merek-admin')->extends('layouts.main')->section('content');
    }

    public function formBuat()
    {
        if ($this->pagebuat == false) {
            $this->pagebuat = true;
        }
        if ($this->pageedit == true) {
            $this->pageedit = false;
        }
        $this->nama = NULL;
    }

    public function buatKategori()
    {
        $this->validate([
            'nama' => 'required|min:3'
        ]);

        $buat = ProdukMerek::create([
            'nama' => $this->nama
        ]);
        $this->nama = null;
        $this->emit('success', ['pesan' => 'berhasil buat merek']);
    }

    public function formEdit($id)
    {
        if ($this->pagebuat == true) {
            $this->pagebuat = false;
        }
        if ($this->pageedit == true) {
            $this->pageedit = false;
        }

        $this->pageedit = true;
        $this->nama = NULL;

        $data = ProdukMerek::find($id);
        $this->byid = $data->id;
        $this->nama = $data->nama;
    }

    public function editKategori()
    {
        $edit = ProdukMerek::find($this->byid);

        $edit->update([
            'nama' => $this->nama
        ]);

        $this->byid = null;
        $this->nama = null;

        $this->pageedit = false;

        $this->emit('success', ['pesan' => 'berhasil edit merek']);
    }

    public function hapus($id)
    {
        ProdukMerek::find($id)->delete();
        $this->emit('success', ['pesan' => 'berhasil hapus merek']);
    }
}
