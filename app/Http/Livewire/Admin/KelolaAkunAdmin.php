<?php

namespace App\Http\Livewire\Admin;

use App\Models\Konsumen;
use App\Models\Pegawai;
use Livewire\Component;

class KelolaAkunAdmin extends Component
{
    public $akun = [];

    public function ubahstatus($id)
    {
        $d = Pegawai::find($id);
        if ($d->isaktif == true) {
            $d->update([
                'isaktif' => false
            ]);
        }else {
            $d->update([
                'isaktif' => true
            ]);
        }
    }

    public function render()
    {
        $this->akun = Pegawai::latest()->get();

        return view('livewire.admin.kelola-akun-admin')->extends('layouts.main')->section('content');
    }
}
