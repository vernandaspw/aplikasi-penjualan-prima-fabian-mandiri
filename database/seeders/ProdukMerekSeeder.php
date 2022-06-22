<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProdukMerekSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('produk_mereks')->insert([
            [
                'nama' => 'Paragons',
            ],
            [
                'nama' => 'venus',
            ],
            [
                'nama' => 'goldsat',
            ],
            [
                'nama' => 'tanaka',
            ],
            [
                'nama' => 'skyview',
            ],

            [
                'nama' => 'yuri',
            ],
            [
                'nama' => 'kitani'
            ],
            [
                'nama' => 'hisharp'
            ],
            [
                'nama' => 'AHD'
            ],
            [
                'nama' => 'Matrix'
            ],
            [
                'nama' => 'mmp'
            ],
            [
                'nama' => 'audax'
            ],
            [
                'nama' => 'bmb'
            ],
            [
                'nama' => 'geisler'
            ],
            [
                'nama' => 'tvcom'
            ],
            [
                'nama' => 'wansonic'
            ],
            [
                'nama' => 'wonder8'
            ],
            [
                'nama' => 'xinzie'
            ],
        ]);

    }
}
