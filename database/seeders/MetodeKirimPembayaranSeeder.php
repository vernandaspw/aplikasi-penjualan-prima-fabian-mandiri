<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MetodeKirimPembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('metode_kirim_pembayarans')->insert([
            [
                'metode_kirim_id' => 1,
                'metode_pembayaran_id' => 1
            ],
            [
                'metode_kirim_id' => 1,
                'metode_pembayaran_id' => 2
            ],
            [
                'metode_kirim_id' => 1,
                'metode_pembayaran_id' => 3
            ],
            [
                'metode_kirim_id' => 1,
                'metode_pembayaran_id' => 4
            ],
            [
                'metode_kirim_id' => 2,
                'metode_pembayaran_id' => 1
            ],
            [
                'metode_kirim_id' => 2,
                'metode_pembayaran_id' => 2
            ],
            [
                'metode_kirim_id' => 2,
                'metode_pembayaran_id' => 4
            ],
            [
                'metode_kirim_id' => 3,
                'metode_pembayaran_id' => 1
            ],
            [
                'metode_kirim_id' => 3,
                'metode_pembayaran_id' => 2
            ],
            [
                'metode_kirim_id' => 3,
                'metode_pembayaran_id' => 4
            ],
        ]);
    }
}
