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
        Schema::create('keranjang_items', function (Blueprint $table) {
            $table->id();
            $table->foreignId('konsumen_id')->nullable()->constrained('konsumens')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('pegawai_id')->nullable()->constrained('pegawais')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('keranjang_id')->constrained('keranjangs')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('produk_id')->nullable()->constrained('produks')->onUpdate('cascade')->onDelete('set null');
            $table->integer('qty')->default(0);
            $table->decimal('total_harga',19,2)->default(0);
            $table->decimal('total_modal',19,2)->default(0);
            $table->decimal('total_berat',7,2)->default(0);
            $table->boolean('selected')->default(false);
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
        Schema::dropIfExists('keranjang_items');
    }
};
