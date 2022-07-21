<?php

namespace App\Exports;

use App\Models\Transaksi;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\FromCollection;

class LaporanPenjualanExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */

    use Exportable;

    public function __construct($data, $start, $end)
    {
        $this->start_date = $start;
        $this->end_date = $end;
        $this->data = $data;
    }

    public function view(): View
    {
        // dd($this->start_date);
        return view('Exports.laporan-penjualan', [
            'start' => $this->start_date,
            'end' => $this->end_date,
            'datas' => $this->data
        ]);
    }
}
