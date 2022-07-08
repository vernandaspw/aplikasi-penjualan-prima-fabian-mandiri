<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('transaksis', function (Blueprint $table) {
            $table->id();
            $table->string('no_transaksi',16)->unique();
            $table->foreignId('transaksi_jenis_id')->nullable()->constrained('transaksi_jenis')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('transaksi_kategori_id')->nullable()->constrained('transaksi_kategoris')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('konsumen_id')->nullable()->constrained('konsumens')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('pegawai_id')->nullable()->constrained('pegawais')->onUpdate('cascade')->onDelete('set null');
            $table->string('nama_konsumen',25)->nullable();
            $table->string('nowa_konsumen',15)->nullable();
            $table->longText('alamat_konsumen')->nullable();
            $table->foreignId('metode_kirim_id')->nullable()->constrained('metode_kirims')->onUpdate('cascade')->onDelete('set null');
            $table->string('no_resi',30)->nullable();
            $table->foreignId('metode_pembayaran_id')->nullable()->constrained('metode_pembayarans')->onUpdate('cascade')->onDelete('set null');
            $table->decimal('total_belanja',19,2)->default(0);
            $table->decimal('kode_unik',5,2)->default(0);
            $table->decimal('biaya_kirim',10,2)->default(0);
            $table->decimal('total_pembayaran',19,2)->default(0);
            $table->decimal('diterima',19,2)->default(0)->nullable();
            $table->decimal('kembalian',19,2)->default(0)->nullable();
            $table->decimal('total_modal',19,2)->default(0);
            $table->decimal('total_berat',7,2)->default(0);
            $table->decimal('laba_penjualan_produk',19,2)->default(0);
            $table->decimal('laba_penjualan_bersih',19,2)->default(0);
            $table->longText('catatan')->nullable();
            $table->enum('status',['konfirm','proses_pembayaran', 'sedang_dikemas', 'sedang_antar','diterima','selesai', 'gagal', 'batal', 'retur']);
            $table->boolean('islunas')->default(true);
            $table->timestampTz('pembayaran_expired_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('transaksis');
    }
};
