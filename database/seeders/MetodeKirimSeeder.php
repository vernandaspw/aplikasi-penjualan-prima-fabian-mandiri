<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetodeKirimSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('metode_kirims')->insert([
            [
                'id' => 1,
                'metode' => 'logistik perusahaan',
                'nama' => null,
                'biaya' => 0,
                'isaktif' => true
            ],
            [
                'id' => 2,
                'metode' => 'logistik lainnya',
                'nama' => null,
                'biaya' => 0,
                'isaktif' => true
            ],
            [
                'id' => 3,
                'metode' => 'ambil ditempat',
                'nama' => null,
                'biaya' => 0,
                'isaktif' => true
            ],
        ]);
    }
}
