<?php

namespace App\Http\Livewire\Admin;

use App\Models\Konsumen;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class KelolaAkunAdmin extends Component
{
    public $akun = [];

    public $pagebuat, $pageedit = false;


    public $byid, $nama, $nohp, $email, $password, $ulangipassword, $role, $isaktif;



    public function render()
    {
        $this->akun = Pegawai::latest()->get();

        return view('livewire.admin.kelola-akun-admin')->extends('layouts.main')->section('content');
    }

    public function resetNull()
    {
        $this->nama = null;
        $this->nohp = null;
        $this->email = null;
        $this->password = null;
        $this->role = null;
        $this->isaktif = null;
    }

    public function buatakun()
    {
        $this->validate([
            'nama' => 'max:25|required',
            'nohp' => 'max:15|required',
            'email' => 'max:80|required',
            'password' => 'required',
            'ulangipassword' => 'same:password',
            'role' => 'required'
        ]);

        $data = Pegawai::create([
            'nama' => $this->nama,
            'nohp' =>  $this->nohp,
            'email' => $this->email,
            'password' => Hash::make($this->password),
            'role' => $this->role
        ]);

        $this->resetNull();
        $this->emit('success', ['pesan' => 'berhasil buat data']);
    }

    public function edit($id)
    {
        $this->pageedit = true;
        $this->pagebuat = false;

        $data = Pegawai::find($id);

        $this->byid = $data->id;
        $this->nama = $data->nama;
        $this->nohp = $data->nohp;
        $this->email = $data->email;
        $this->password = null;
        $this->role = $data->role;
    }

    public function editakun($id)
    {
        $data = Pegawai::find($id);

        $data->update([
            'nama' => $this->nama,
            'nohp' =>  $this->nohp,
            'email' => $this->email,
            'password' => $this->password == null ? $data->password : Hash::make($this->password),
            'role' => $this->role,
        ]);

        $this->emit('success', ['pesan' => 'berhasil edit data']);
    }

    public function tutup()
    {
        $this->resetNull();
        $this->pageedit = false;
    }

    public function ubahstatus($id)
    {
        $d = Pegawai::find($id);
        if ($d->isaktif == true) {
            $d->update([
                'isaktif' => false
            ]);
        } else {
            $d->update([
                'isaktif' => true
            ]);
        }
    }
}
