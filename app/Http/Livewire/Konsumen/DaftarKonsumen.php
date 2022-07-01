<?php

namespace App\Http\Livewire\Konsumen;

use App\Models\Keranjang;
use App\Models\Konsumen;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class DaftarKonsumen extends Component
{
    public $nama, $jeniskelamin, $wilayah, $nohp, $email, $password, $ulangi_password;

    public function daftar()
    {
        $this->validate([
            'nama' => 'required|max:25',
            'jeniskelamin' => 'required',
            'nohp' => 'required|max:15|unique:konsumens,nohp',
            'email' => 'required|max:80|email',
            'password' => ['required', Password::min(6)->numbers()->mixedCase()],
            'ulangi_password' => 'same:password',
            'wilayah' => 'nullable|max:30'
        ]);

        try {
           $login = Konsumen::create([
                'nama' => $this->nama,
                'jeniskelamin' => $this->jeniskelamin,
                'nohp' => $this->nohp,
                'email' => $this->email,
                'password' => Hash::make($this->password),
                'wilayah' => $this->wilayah
            ]);
            Keranjang::create([
                'konsumen_id' => $login->id
            ]);

            if (auth('konsumen')->loginUsingId($login->id, false)) {
                session()->regenerate();
                redirect()->to('/');
            }
        } catch (\Exception $e) {
            // $this->emit('error', ['pesan' => $e->getMessage()]);
        }
    }

    public function render()
    {
        return view('livewire.konsumen.daftar-konsumen')->extends('layouts.main')->section('content');
    }
}
