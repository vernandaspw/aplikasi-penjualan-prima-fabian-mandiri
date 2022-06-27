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
                'no_telp' => '0711412413',
                'no_wa' => '8532532524',
                'ig' => 'iramatoko',
                'sejarah' => 'PT. Prima Fabian Mandiri Palembang berdiri sejak tanggal 13 Januari 2015, yang bergerak di bidang perdagangan sebagai distributor produk dan sparepart elektronik. Perusahaan ini didirikan oleh Daniel Fabian Soendoko dan Darmawan pada tanggal 13 Januari 2015. PT. Prima Fabian Mandiri memiliki NPWP: 72.162.330.4-307.000. Kantor PT. Prima Fabian Mandiri berlokasi di Jalan Veteran No. 757L Kelurahan Kuto Batu Kecamatan Ilir Timur II Kota Palembang. Gudang barang PT. Prima Fabian Mandiri berlokasi di Pasar 16 tepatnya di Jalan Beringin Janggut No. II, 17 Ilir, Kec. Ilir Timur. I, Kota Palembang, Sumatera Selatan 30111. ',
                'visi' => 'Menjadi perusahaan di bidang penyedia produk elektronik yang maju dan terkemuka di Indonesia',
                'misi' => 'Berikut ini adalah misi PT. Prima Fabian Mandiri:
                <br>
                1)	Membangun sumber daya manusia yang berkompeten dan berbudi luhur.
                <br>
                2)	Meningkatkan kualitas barang elektronik yang dijual.
                <br>
                3)	Menawarkan barang - barang elektronik berkualitas tinggi dan berteknologi terbaru.
                <br>
                4)	Mewujudkan keinginan konsumen untuk terus memperbaiki kualitas produk.
                <br>
                5)	Bertanggung jawab pada setiap kualitas produk hingga ke tangan konsumen dan Memaksimalkan pelayanan berbasis teknologi informasi.
                ',
                'provinsi' => 'sumatera selatan',
                'kota' => 'palembang',
                'kecamatan' => 'ilir timur 1',
                'alamat' => 'jl. adipati nomor 13',
                'kodepos' => '30151',

        ]);
    }
}
