<?php

namespace App\Http\Livewire\Konsumen;

use App\Models\Konsumen;
use App\Models\Pegawai;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class LoginKonsumen extends Component
{

    public $email, $password;
    public $ingat = true;

    public function login()
    {
        $this->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $konsumen = Konsumen::where('email', $this->email)->first();
        $pegawai = Pegawai::where('email', $this->email)->first();
        if ($konsumen == true && $pegawai == true) {
            if (Hash::check($this->password, $konsumen->password) == true && Hash::check($this->password, $pegawai->password) == true) {
                auth('konsumen')->loginUsingId($konsumen->id, $this->ingat);
                if ($pegawai->isaktif == true) {
                    if (auth('pegawai')->loginUsingId($pegawai->id, $this->ingat)) {
                        session()->regenerate();
                        redirect()->to('/');
                    } else {
                        session()->flash('msg_error', 'gagal login');
                    }
                } else {
                    session()->flash('msg_error', 'maaf, akun perusahaan tidak aktif');
                    session()->regenerate();
                    redirect()->to('/');
                }
                session()->regenerate();
                redirect()->to('/');
            } else {
                session()->flash('msg_error', 'password salah');
            }
        } else if ($konsumen) {
            if (Hash::check($this->password, $konsumen->password)) {
                if (auth('konsumen')->loginUsingId($konsumen->id, $this->ingat)) {
                    session()->regenerate();
                    redirect()->to('/');
                } else {
                    session()->flash('msg_error', 'gagal login');
                }
            } else {
                session()->flash('msg_error', 'password salah');
            }
        } elseif ($pegawai) {
            if (Hash::check($this->password, $pegawai->password)) {
                if ($pegawai->isaktif == true) {
                    if (auth('pegawai')->loginUsingId($pegawai->id, $this->ingat)) {
                        session()->regenerate();
                        redirect()->to('admin');
                    } else {
                        session()->flash('msg_error', 'gagal login');
                    }
                } else {
                    session()->flash('msg_error', 'maaf, akun tidak aktif');
                }
            } else {
                session()->flash('msg_error', 'password salah');
            }
        } else {
            session()->flash('msg_error', 'email tidak ditemukan');
        }
    }


    public function render()
    {
        return view('livewire.konsumen.login-konsumen')->extends('layouts.main')->section('content');
    }
}
