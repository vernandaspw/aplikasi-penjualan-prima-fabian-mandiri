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
        Schema::create('transaksi_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaksi_id')->constrained('transaksis')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('produk_id')->nullable()->constrained('produks')->onUpdate('cascade')->onDelete('set null');
            $table->integer('qty')->default(0);
            $table->decimal('total_harga',19,2)->default(0);
            $table->decimal('total_modal',19,2)->default(0);
            $table->foreignId('produk_ulasan_id')->nullable()->constrained('produk_ulasans')->onUpdate('cascade')->onDelete('set null');
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
        Schema::dropIfExists('transaksi_items');
    }
};
