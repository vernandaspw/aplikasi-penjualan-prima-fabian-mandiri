<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('produk_kategoris')->insert([

            [
                'nama' => 'RECIVIER',
            ],
            [
                'nama' => 'LNB',
            ],
            [
                'nama' => 'ACCESORIES',
            ],
            [
                'nama' => 'CHARGER AKI',
            ],

            [
                'nama' => 'KABEL',
            ],

            [
                'nama' => 'TRAFO'
            ],
            [
                'nama' => 'TOA'
            ],
            [
                'nama' => 'CCTV'
            ],
            [
                'nama' => 'STABILIZER'
            ],
            [
                'nama' => 'PARABOLA',
            ],
            [
                'nama' => 'HOME AUDIO'
            ]
        ]);
    }
}
