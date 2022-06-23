<?php

namespace App\Http\Livewire\Konsumen;

use App\Models\Konsumen;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AkunKonsumen extends Component
{
    public $akun;
    public function render()
    {
        if (auth('konsumen')->check()) {
            $this->akun = Konsumen::findOrFail(auth('konsumen')->user()->id);
        }else {
            $this->akun = 'login';
        }

        return view('livewire.konsumen.akun-konsumen');
    }

    public function logout()
    {
        auth('konsumen')->logout();
        session()->invalidate();
        session()->regenerateToken();
        redirect('/');
    }
}
