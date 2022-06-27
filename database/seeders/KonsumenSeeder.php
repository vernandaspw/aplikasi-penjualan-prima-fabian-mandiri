<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class KonsumenSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('konsumens')->insert([
            [
                'nama' => 'jhon doe',
                'jeniskelamin' => 'laki laki',
                'nohp' => '89660741134',
                'wilayah' => 'lalan',
                'email' => 'konsumen@gmail.com',
                'password' => Hash::make('konsumen'),
                'provinsi' => 'sumatera selatan',
                'kota' => 'palembang',
                'kecamatan' => 'sukarami',
                'alamat' => 'jl. adipati nomor 13',
                'patokan' => 'depan lapangan ya',
                'kodepos' => '30151',
            ],
            [
                'nama' => 'nakama doe',
                'jeniskelamin' => 'perempuan',
                'nohp' => '89660741136',
                'wilayah' => 'lalan',
                'email' => 'konsumen2@gmail.com',
                'password' => Hash::make('konsumen'),
                'provinsi' => 'sumatera selatan',
                'kota' => 'palembang',
                'kecamatan' => 'sukarami',
                'alamat' => 'jl. adipati nomor 13',
                'patokan' => 'depan lapangan ya',
                'kodepos' => '30151',
            ],

        ]);
    }
}
