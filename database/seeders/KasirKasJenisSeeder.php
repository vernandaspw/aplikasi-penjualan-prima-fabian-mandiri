<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KasirKasJenisSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('kasir_kas_jenis')->insert([
            [
                'id' => 1,
                'nama' => 'masuk'
            ],
            [
                'id' => 2,
                'nama' => 'keluar'
            ],
            [
                'id' => 3,
                'nama' => 'tutup'
            ],

        ]);
    }
}
