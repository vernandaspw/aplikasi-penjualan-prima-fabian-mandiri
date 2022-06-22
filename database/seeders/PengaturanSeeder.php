<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PengaturanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pengaturans')->insert([

                'nm_perusahaan' => 'PT. Prima Febian Mandiri',
                'nm_toko' => 'Irama Baru',
                'no_telp' => '0711412413',
                'no_wa' => '8532532524',
                'ig' => 'iramatoko',
                'tentang' => ' Lorem ipsum dolor sit amet, consectetur adipiscing elit ut aliquam dipiscing elit ut
                aliquam dipis ing elit ut aliquam dipiscing elit ut aliquam dipis,  Lorem ipsum dolor sit amet, consectetur adipiscing elit ut aliquam dipiscing elit ut
                aliquam dipis ing elit ut aliquam dipiscing elit ut aliquam dipis',
                'provinsi' => 'sumatera selatan',
                'kota' => 'palembang',
                'kecamatan' => 'ilir timur 1',
                'alamat' => 'jl. adipati nomor 13',
                'kodepos' => '30151',

        ]);
    }
}
