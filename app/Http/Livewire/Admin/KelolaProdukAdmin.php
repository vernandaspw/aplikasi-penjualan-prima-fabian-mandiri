<?php

namespace App\Http\Livewire\Admin;

use App\Models\Produk;
use App\Models\ProdukGaleri;
use App\Models\ProdukKategori;
use App\Models\ProdukMerek;
use App\Models\ProdukStok;
use Illuminate\Support\Facades\Storage;
use Livewire\Component;
use Livewire\WithFileUploads;

class KelolaProdukAdmin extends Component
{
    use WithFileUploads;

    public $produk, $kategori, $merek = [];
    public $jmlkategori, $jmlmerek, $jmlproduk;

    public $take = 10;

    public $cariproduk;

    public $pagebuat, $pageedit = false;

    public $byid, $nama, $barcode, $produk_kategori_id, $produk_merek_id, $deskripsi;

    public  $harga_jual, $harga_modal, $berat_kg = 0;
    public $istersedia;

    public $gambar, $gambar2, $gambar3, $gambar4, $gambar5, $gambar6;
    public $inputgambar2, $inputgambar3, $inputgambar4, $inputgambar5, $inputgambar6 = false;
    public $editgambar, $editgambar2, $editgambar3, $editgambar4, $editgambar5, $editgambar6;

    public $stok, $stok_minimum = 0;
    public $satuan_unit;
    public $isstok = true;


    public function lanjut()
    {
        $this->take = $this->take + 10;
    }

    public function inputgambar2()
    {
        $this->inputgambar2 = true;
    }
    public function hapusinputgambar2()
    {
        $this->gambar2 = null;
        $this->inputgambar2 = false;
    }
    public function inputgambar3()
    {
        $this->inputgambar3 = true;
    }
    public function hapusinputgambar3()
    {
        $this->gambar3 = null;
        $this->inputgambar3 = false;
    }
    public function inputgambar4()
    {
        $this->inputgambar4 = true;
    }
    public function hapusinputgambar4()
    {
        $this->gambar4 = null;
        $this->inputgambar4 = false;
    }
    public function inputgambar5()
    {
        $this->inputgambar5 = true;
    }
    public function hapusinputgambar5()
    {
        $this->gambar5 = null;
        $this->inputgambar5 = false;
    }
    public function inputgambar6()
    {
        $this->inputgambar6 = true;
    }
    public function hapusinputgambar6()
    {
        $this->gambar6 = null;
        $this->inputgambar6 = false;
    }

    public function render()
    {
        $produk = Produk::with('kategori', 'merek', 'gambar');

        if ($this->cariproduk) {
            $this->produk = $produk->where('nama', 'LIKE', '%' . $this->cariproduk . '%')->orWhere('barcode', 'like', '%' . $this->cariproduk . '%')->latest()->take($this->take)->get();
        }
        $this->produk = $produk->latest()->take($this->take)->get();
        // dd($this->produk);
        $this->jmlproduk = Produk::get()->count();
        $this->jmlkategori = ProdukKategori::get()->count();
        $this->jmlmerek = ProdukMerek::get()->count();

        $this->kategori = ProdukKategori::latest()->get();
        $this->merek = ProdukMerek::latest()->get();
        return view('livewire.admin.kelola-produk-admin')->extends('layouts.main')->section('content');
    }

    public function resetNull()
    {
        $this->byid = null;
        $this->nama = null;
        $this->barcode = null;
        $this->produk_kategori_id = null;
        $this->produk_merek_id = null;
        $this->harga_jual = 0;
        $this->harga_modal = 0;
        $this->berat_kg = 0;
        $this->deskripsi = null;
        $this->gambar = null;
        $this->gambar2 = null;
        $this->gambar3 = null;
        $this->gambar4 = null;
        $this->gambar5 = null;
        $this->gambar6 = null;

        $this->editgambar = null;
        $this->editgambar2 = null;
        $this->editgambar3 = null;
        $this->editgambar4 = null;
        $this->editgambar5 = null;
        $this->editgambar6 = null;

        $this->stok = null;
        $this->satuan_unit = null;
        $this->stok_minimum = null;
        $this->isstok = null;
    }

    public function buatform()
    {
        $this->pageedit = false;
        $this->pagebuat = true;

        $this->resetNull();
    }

    public function buat()
    {
        $this->validate([
            'nama' =>  'required|max:90|unique:produks,nama',
            'barcode' => 'nullable|max:50',
            'produk_kategori_id' => 'nullable',
            'produk_merek_id' => 'nullable',
            'harga_jual' => 'required|max:99999999999999999',
            'harga_modal' => 'nullable|max:99999999999999999',
            'berat_kg' => 'nullable|max:99999',
            'deskripsi' => 'nullable|max:800',
            'gambar' => 'nullable|image|max:2024',
            'gambar2' => 'nullable|image|max:2024',
            'gambar3' => 'nullable|image|max:2024',
            'gambar4' => 'nullable|image|max:2024',
            'gambar5' => 'nullable|image|max:2024',
            'gambar6' => 'nullable|image|max:2024',
        ]);

        $data = Produk::create([
            'nama' => $this->nama,
            'barcode' => $this->barcode,
            'produk_kategori_id' => $this->produk_kategori_id,
            'produk_merek_id' => $this->produk_merek_id,
            'harga_jual' => $this->harga_jual,
            'harga_modal' => $this->harga_modal,
            'berat_kg' => $this->berat_kg,
            'deskripsi' => $this->deskripsi
        ]);

        if ($this->gambar) {
            $gambar = $this->gambar->store('produk');
        }
        ProdukGaleri::create([
            'no' => 1,
            'produk_id' => $data->id,
            'img' => $this->gambar == null ? null : $gambar
        ]);
        if ($this->gambar2) {
            $gambar2 = $this->gambar2->store('produk');
        }
        ProdukGaleri::create([
            'no' => 2,
            'produk_id' => $data->id,
            'img' => $this->gambar2 == null ? null : $gambar2
        ]);
        if ($this->gambar3) {
            $gambar3 = $this->gambar3->store('produk');
        }
        ProdukGaleri::create([
            'no' => 3,
            'produk_id' => $data->id,
            'img' => $this->gambar3 == null ? null : $gambar3
        ]);
        if ($this->gambar4) {
            $gambar4 = $this->gambar4->store('produk');
        }
        ProdukGaleri::create([
            'no' => 4,
            'produk_id' => $data->id,
            'img' => $this->gambar4 == null ? null : $gambar4
        ]);
        if ($this->gambar5) {
            $gambar5 = $this->gambar5->store('produk');
        }
        ProdukGaleri::create([
            'no' => 5,
            'produk_id' => $data->id,
            'img' => $this->gambar5 == null ? null : $gambar5
        ]);
        if ($this->gambar6) {
            $gambar6 = $this->gambar6->store('produk');
        }
        ProdukGaleri::create([
            'no' => 6,
            'produk_id' => $data->id,
            'img' => $this->gambar6 == null ? null : $gambar6
        ]);

        ProdukStok::create([
            'produk_id' => $data->id,
            'satuan_unit' => $this->satuan_unit == null ? 'pcs' : $this->satuan_unit,
            'po' => $this->stok == null ? 0 : $this->stok,
            'real' => $this->stok == null ? 0 : $this->stok,
            'stok_minimum' => $this->stok_minimum,
            'isstok' => $this->isstok
        ]);

        $this->resetNull();

        $this->emit('success', ['pesan' => 'berhasil buat data']);
    }

    public function editform($id)
    {
        $this->pageedit = true;
        $this->pagebuat = false;

        $data = Produk::with('gambar', 'produkstok')->find($id);

        $gambar = ProdukGaleri::where('produk_id', $data->id)->orderBy('no')->get();
        $this->byid = $data->id;
        $this->nama = $data->nama;
        $this->barcode = $data->barcode;
        $this->produk_kategori_id = $data->produk_kategori_id;
        $this->produk_merek_id = $data->produk_merek_id;
        $this->harga_jual = $data->harga_jual;
        $this->harga_modal = $data->harga_modal;
        $this->berat_kg = $data->berat_kg;
        $this->deskripsi = $data->deskripsi;
        $this->gambar = $gambar[0];
        $this->gambar2 = $gambar[1];
        $this->gambar3 = $gambar[2];
        $this->gambar4 = $gambar[3];
        $this->gambar5 = $gambar[4];
        $this->gambar6 = $gambar[5];

        $stoks = ProdukStok::find($data->produkstok->id);
        $this->isstok = $stoks->isstok;


    }

    public function edit($id)
    {
        $data = Produk::with('produkstok')->find($id);

        $cek = $data->update([
            'nama' => $this->nama,
            'barcode' => $this->barcode,
            'produk_kategori_id' => $this->produk_kategori_id,
            'produk_merek_id' => $this->produk_merek_id,
            'harga_jual' => $this->harga_jual,
            'harga_modal' => $this->harga_modal,
            'berat_kg' => $this->berat_kg,
            'deskripsi' => $this->deskripsi
        ]);

        ProdukStok::find($data->produkstok->id)->update([
            'isstok' => $this->isstok
        ]);

        if ($cek) {
            if ($this->editgambar) {
                $galeris = ProdukGaleri::find($this->gambar->id);
                if ($galeris->img) {
                    $gambarstore = $this->editgambar->store('produk');
                    if ($gambarstore) {
                        Storage::delete($galeris->img);
                        $galeris->update([
                            'img' => $gambarstore
                        ]);
                    }
                }
                $gambarstore = $this->editgambar->store('produk');
                $galeris->update([
                    'img' => $gambarstore
                ]);
            }
            if ($this->editgambar2) {
                $galeris2 = ProdukGaleri::find($this->gambar2->id);
                if ($galeris2->img) {
                    $gambarstore2 = $this->editgambar2->store('produk');
                    if ($gambarstore2) {
                        Storage::delete($galeris2->img);
                        $galeris2->update([
                            'img' => $gambarstore2
                        ]);
                    }
                }
                $gambarstore2 = $this->editgambar2->store('produk');
                $galeris2->update([
                    'img' => $gambarstore2
                ]);
            }
            if ($this->editgambar3) {
                $galeris3 = ProdukGaleri::find($this->gambar3->id);
                if ($galeris3->img) {
                    $gambarstore3 = $this->editgambar3->store('produk');
                    if ($gambarstore3) {
                        Storage::delete($galeris3->img);
                        $galeris3->update([
                            'img' => $gambarstore3
                        ]);
                    }
                }
                $gambarstore3 = $this->editgambar3->store('produk');
                $galeris3->update([
                    'img' => $gambarstore3
                ]);
            }
            if ($this->editgambar4) {
                $galeris4 = ProdukGaleri::find($this->gambar4->id);
                if ($galeris4->img) {
                    $gambarstore4 = $this->editgambar4->store('produk');
                    if ($gambarstore4) {
                        Storage::delete($galeris4->img);
                        $galeris4->update([
                            'img' => $gambarstore4
                        ]);
                    }
                }
                $gambarstore4 = $this->editgambar4->store('produk');
                $galeris4->update([
                    'img' => $gambarstore4
                ]);
            }
            if ($this->editgambar5) {
                $galeris5 = ProdukGaleri::find($this->gambar5->id);
                if ($galeris5->img) {
                    $gambarstore5 = $this->editgambar5->store('produk');
                    if ($gambarstore5) {
                        Storage::delete($galeris5->img);
                        $galeris5->update([
                            'img' => $gambarstore5
                        ]);
                    }
                }
                $gambarstore5 = $this->editgambar5->store('produk');
                $galeris5->update([
                    'img' => $gambarstore5
                ]);
            }
            if ($this->editgambar6) {
                $galeris6 = ProdukGaleri::find($this->gambar6->id);
                if ($galeris6->img) {
                    $gambarstore6 = $this->editgambar6->store('produk');
                    if ($gambarstore6) {
                        Storage::delete($galeris6->img);
                        $galeris6->update([
                            'img' => $gambarstore6
                        ]);
                    }
                }
                $gambarstore6 = $this->editgambar6->store('produk');
                $galeris6->update([
                    'img' => $gambarstore6
                ]);
            }


            $this->emit('success', ['pesan' => 'berhasil edit data']);
        } else {
            $this->emit('error', ['pesan' => 'gagal edit data']);
        }
    }

    public function tutup()
    {
        $this->resetNull();
        $this->pageedit = false;
        $this->pagebuat = false;
    }

    public function ubahstatus($id)
    {
        $d = Produk::find($id);
        if ($d->istersedia == true) {
            $d->update([
                'istersedia' => false
            ]);
        } else {
            $d->update([
                'istersedia' => true
            ]);
        }
    }
}
