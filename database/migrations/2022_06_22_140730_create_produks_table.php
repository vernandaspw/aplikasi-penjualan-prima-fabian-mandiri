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
        Schema::create('produks', function (Blueprint $table) {
            $table->id();
            $table->string('nama',90)->unique();
            $table->string('barcode', 50)->nullable();
            $table->foreignId('produk_kategori_id')->constrained('produk_kategoris')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('produk_merek_id')->constrained('produk_mereks')->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('harga_jual',19,2)->default(0);
            $table->decimal('harga_modal',19,2)->default(0);
            $table->decimal('berat_kg', 7,2)->nullable();
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
        Schema::dropIfExists('produks');
    }
};
