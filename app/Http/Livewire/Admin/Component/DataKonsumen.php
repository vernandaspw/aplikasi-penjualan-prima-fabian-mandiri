<?php

namespace App\Http\Livewire\Admin\Component;

use App\Models\Konsumen;
use Livewire\Component;

class DataKonsumen extends Component
{
    public $konsumen = [];
    public $take = 15;
    public $jml_item;

    public function lanjut()
    {
        $this->take = $this->take + 15;
    }

    public function render()
    {
        $this->konsumen = Konsumen::latest()->get();

        $this->jml_item = Konsumen::latest()->get()->count();

        return view('livewire.admin.component.data-konsumen')->extends('layouts.main')->section('content');
    }
}
