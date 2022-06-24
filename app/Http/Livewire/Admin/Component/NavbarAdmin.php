<?php

namespace App\Http\Livewire\Admin\Component;

use Livewire\Component;

class NavbarAdmin extends Component
{
    public function logout()
    {
        auth('pegawai')->logout();
        session()->invalidate();
        session()->regenerateToken();
        redirect('admin/login');
    }

    public function render()
    {
        return view('livewire.admin.component.navbar-admin');
    }
}
