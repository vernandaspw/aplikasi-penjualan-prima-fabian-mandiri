<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TransaksiKategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transaksi_kategoris')->insert([
            [
                'transaksi_jenis_id' => 1,
                'nama' => 'penjualan'
            ],
            [
                'transaksi_jenis_id' => 1,
                'nama' => 'pendapatan diluar usaha'
            ],
            [
                'transaksi_jenis_id' => 1,
                'nama' => 'penagihan utang'
            ],
            [
                'transaksi_jenis_id' => 1,
                'nama' => 'terima pinjaman'
            ],
            [
                'transaksi_jenis_id' => 1,
                'nama' => 'penambahan modal'
            ],
            [
                'transaksi_jenis_id' => 1,
                'nama' => 'pendapatan jasa'
            ],
            [
                'transaksi_jenis_id' => 1,
                'nama' => 'pendapatan lain lain'
            ],

            //

            [
                'transaksi_jenis_id' => 2,
                'nama' => 'pembelian'
            ],
            [
                'transaksi_jenis_id' => 2,
                'nama' => 'persediaan'
            ],
            [
                'transaksi_jenis_id' => 2,
                'nama' => 'biaya operasional'
            ],
            [
                'transaksi_jenis_id' => 2,
                'nama' => 'upah'
            ],
            [
                'transaksi_jenis_id' => 2,
                'nama' => 'gaji karyawan'
            ],
            [
                'transaksi_jenis_id' => 2,
                'nama' => 'listrik'
            ],
            [
                'transaksi_jenis_id' => 2,
                'nama' => 'internet'
            ],
            [
                'transaksi_jenis_id' => 2,
                'nama' => 'pengemasan'
            ],
            [
                'transaksi_jenis_id' => 2,
                'nama' => 'utilitas'
            ],
            [
                'transaksi_jenis_id' => 2,
                'nama' => 'pengeluaran lainnya'
            ],


        ]);
    }
}
