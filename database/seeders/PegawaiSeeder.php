<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class PegawaiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('pegawais')->insert([
            [
                'nama' => 'jhon administrator',
                'nohp' => '89660741134',
                'email' => 'administrator@gmail.com',
                'password' => Hash::make('administrator'),
                'role' => 'administrator',
                'isaktif' => true
            ],
            [
                'nama' => 'jhon admin',
                'nohp' => '89660741135',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('admin'),
                'role' => 'admin',
                'isaktif' => true
            ],
            [
                'nama' => 'jhon logistik',
                'nohp' => '89660741136',
                'email' => 'logistik@gmail.com',
                'password' => Hash::make('logistik'),
                'role' => 'logistik',
                'isaktif' => true
            ],
            [
                'nama' => 'jhon pimpinan',
                'nohp' => '89660741137',
                'email' => 'pimpinan@gmail.com',
                'password' => Hash::make('pimpinan'),
                'role' => 'pimpinan',
                'isaktif' => true
            ],
        ]);
    }
}
