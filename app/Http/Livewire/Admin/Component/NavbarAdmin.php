<?php

namespace App\Http\Livewire\Admin\Component;

use App\Models\Transaksi;
use Livewire\Component;

class NavbarAdmin extends Component
{
    public $pesananmasuk, $prosesantar;

    public function logout()
    {
        auth('pegawai')->logout();
        session()->invalidate();
        session()->regenerateToken();
        redirect('login');
    }

    public function render()
    {
        $this->pesananmasuk  = Transaksi::with('konsumen', 'transaksi_kategori', 'transaksi_jenis', 'metodekirim', 'metodepembayaran')->where('status', 'sedang_dikemas')->get()->count();
        $this->prosesantar  = Transaksi::with('konsumen', 'transaksi_kategori', 'transaksi_jenis', 'metodekirim', 'metodepembayaran')->where('status', 'sedang_antar')->get()->count();
        // $this->semua  = Transaksi::with('konsumen', 'transaksi_kategori', 'transaksi_jenis', 'metodekirim', 'metodepembayaran')->get()->count();

        return view('livewire.admin.component.navbar-admin');
    }
}
