<?php

namespace App\Http\Livewire\Admin;

use App\Models\Pegawai;
use Illuminate\Support\Facades\Hash;
use Livewire\Component;

class LoginAdmin extends Component
{

    public $email, $password;
    public $ingat = true;

    public function login()
    {
        $this->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        $pegawai = Pegawai::where('email', $this->email)->first();
        if ($pegawai) {
            if (Hash::check($this->password, $pegawai->password)) {
                if ($pegawai->isaktif == true) {
                    if (auth('pegawai')->loginUsingId($pegawai->id, $this->ingat)) {
                        session()->regenerate();
                        redirect()->to('admin');
                    } else {
                        session()->flash('msg_error', 'gagal login');
                    }
                }else {
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
        return view('livewire.admin.login-admin')->extends('layouts.main')->section('content');
    }
}
