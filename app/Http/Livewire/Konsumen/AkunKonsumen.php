<?php

namespace App\Http\Livewire\Konsumen;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class AkunKonsumen extends Component
{
    public $akun;
    public function render()
    {
        if (auth('konsumen')->check()) {
            $this->akun = null;
        }else {
            $this->akun = 'login';
        }

        return view('livewire.konsumen.akun-konsumen');
    }
}
