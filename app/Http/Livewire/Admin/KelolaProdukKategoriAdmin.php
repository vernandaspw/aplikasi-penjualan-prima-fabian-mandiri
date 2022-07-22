<?php

namespace App\Http\Livewire\Admin;

use App\Models\ProdukKategori;
use Livewire\Component;

class KelolaProdukKategoriAdmin extends Component
{
    public $produkkategori = [];

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
        $produkkategori = ProdukKategori::take($this->take);

        if ($this->cari) {
            $produkkategori->where('nama', 'LIKE', '%' . $this->cari . '%');
        }
        $this->produkkategori = $produkkategori->latest()->get();
        $this->jmlm_item = ProdukKategori::take($this->take)->latest()->get()->count();
        return view('livewire.admin.kelola-produk-kategori-admin')->extends('layouts.main')->section('content');
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

        $buat = ProdukKategori::create([
            'nama' => $this->nama
        ]);
        $this->nama = null;
        $this->emit('success', ['pesan' => 'berhasil buat kategori']);
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
        
        $data = ProdukKategori::find($id);
        $this->byid = $data->id;
        $this->nama = $data->nama;
    }

    public function editKategori()
    {
        $edit = ProdukKategori::find($this->byid);

        $edit->update([
            'nama' => $this->nama
        ]);

        $this->byid = null;
        $this->nama = null;
        
        $this->pageedit = false;

        $this->emit('success', ['pesan' => 'berhasil edit kategori']);
    }

    public function hapus($id)
    {
        ProdukKategori::find($id)->delete();
        $this->emit('success', ['pesan' => 'berhasil hapus kategori']);
    }
}
