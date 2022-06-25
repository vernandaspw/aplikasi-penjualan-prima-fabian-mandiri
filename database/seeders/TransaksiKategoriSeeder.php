<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransaksiKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transaksi_kategoris')->insert([
            [
                'nama' => 'pembelian'
            ],
            [
                'nama' => 'persediaan'
            ],
            [
                'nama' => 'biaya operasional'
            ],
            [
                'nama' => 'upah'
            ],
            [
                'nama' => 'gaji karyawan'
            ],
            [
                'nama' => 'listrik'
            ],
            [
                'nama' => 'internet'
            ],
            [
                'nama' => 'pengemasan'
            ],
            [
                'nama' => 'utilitas'
            ],
            [
                'nama' => 'pengeluaran lainnya'
            ],
        ]);
    }
}
