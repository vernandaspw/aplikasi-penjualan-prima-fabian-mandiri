<?php

namespace App\Http\Livewire\Konsumen;

use App\Models\Konsumen;
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
        if ($konsumen) {
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
        } else {
           session()->flash('msg_error', 'email tidak ditemukan');
        }
    }


    public function render()
    {
        return view('livewire.konsumen.login-konsumen')->extends('layouts.main')->section('content');
    }
}
