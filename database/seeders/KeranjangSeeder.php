<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class KeranjangSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('keranjangs')->insert([
            [
                'konsumen_id' => 1,
                'pegawai_id' => null,
            ],
            [
                'konsumen_id' => 2,
                'pegawai_id' => null,
            ],
            [
                'konsumen_id' => null,
                'pegawai_id' => 1,
            ],
            [
                'konsumen_id' => null,
                'pegawai_id' => 2,
            ],
            [
                'konsumen_id' => null,
                'pegawai_id' => 3,
            ],
            [
                'konsumen_id' => null,
                'pegawai_id' => 4,
            ],
        ]);
    }
}
