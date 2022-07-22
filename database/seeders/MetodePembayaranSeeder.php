<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetodePembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('metode_pembayarans')->insert([
            [
                'id' => 1,
                'metode' => 'bank transfer',
                'nama' => 'BANK BCA',
                'norek' => '8555056598',
                'an' => 'DANIEL FABIAN S',
                'isaktif' => true
            ],
            [
                'id' => 2,
                'metode' => 'dompet digital',
                'nama' => null,
                'norek' => null,
                'an' => null,
                'isaktif' => false
            ],
            [
                'id' => 3,
                'metode' => 'cod',
                'nama' => 'bayar dirumah',
                'norek' => null,
                'an' => null,
                'isaktif' => true
            ],
            [
                'id' => 4,
                'metode' => 'tunai',
                'nama' => 'bayar ditoko',
                'norek' => null,
                'an' => null,
                'isaktif' => true
            ],

        ]);
    }
}
