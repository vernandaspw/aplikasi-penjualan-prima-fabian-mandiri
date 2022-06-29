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
                'nama' => 'pemasukan'
            ],
            [
                'nama' => 'pengeluaran'
            ]
        ]);
    }
}
