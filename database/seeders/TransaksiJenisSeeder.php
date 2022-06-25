<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransaksiJenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transaksi_jenis')->insert([
            [
                'nama' => 'penjualan'
            ],
            [
                'nama' => 'pendapatan diluar usaha'
            ],
            [
                'nama' => 'penagihan utang'
            ],
            [
                'nama' => 'terima pinjaman'
            ],
            [
                'nama' => 'penambahan modal'
            ],
            [
                'nama' => 'pendapatan lain lain'
            ]
        ]);
    }
}
