<?php

namespace App\Http\Livewire\Konsumen;

use App\Models\Konsumen;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class UbahPasswordKonsumen extends Component
{
    public $konsumen = [];

    public $password, $password_baru, $ulang_password_baru;

    public function mount()
    {
        $konsumen = Konsumen::find(auth('konsumen')->user()->id);
    }
    public function render()
    {
        return view('livewire.konsumen.ubah-password-konsumen')->extends('layouts.main')->section('content');
    }

    public function ubah()
    {
        $this->validate([
            'password' => 'required',
            'password_baru' => ['required', Password::min(6)->numbers()->mixedCase()],
            'ulang_password_baru' => 'same:password_baru'

        ]);
        $data = Konsumen::find(auth('konsumen')->user()->id);
        if (Hash::check($this->password, $data->password)) {
            $data->update([
                'password' => Hash::make($this->password_baru)
            ]);
            $this->emit('success', ['pesan' => 'Berhasil ubah password']);
        } else {
            $this->emit('error', ['pesan' => 'Password lama salah']);
        }
    }
}
