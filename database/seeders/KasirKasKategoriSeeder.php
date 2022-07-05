<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KasirKasKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kasir_kas_kategoris')->insert([
            [
                'kasir_kas_jenis_id' => 1,
                'nama' => 'kas awal',
                'istampil' => false
            ],
            [
                'kasir_kas_jenis_id' => 1,
                'nama' => 'penjualan tunai',
                'istampil' => false
            ],
            [
                'kasir_kas_jenis_id' => 1,
                'nama' => 'tambah kas',
                'istampil' => true
            ],
            [
                'kasir_kas_jenis_id' => 2,
                'nama' => 'tarik kas',
                'istampil' => true
            ],
            [
                'kasir_kas_jenis_id' => 3,
                'nama' => 'kas akhir',
                'istampil' => true
            ],
        ]);
    }
}
