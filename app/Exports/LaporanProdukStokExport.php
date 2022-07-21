<?php

namespace App\Exports;

use App\Models\Produk;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class LaporanProdukStokExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function view(): View
    {
        return view('Exports.laporan-produk-stok', [
            'datas' => $this->data
        ]);
    }
}
