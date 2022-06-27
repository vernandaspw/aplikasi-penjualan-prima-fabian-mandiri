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
            $table->foreignId('produk_kategori_id')->nullable()->constrained('produk_kategoris')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('produk_merek_id')->nullable()->constrained('produk_mereks')->onUpdate('cascade')->onDelete('set null');
            $table->decimal('harga_jual',19,2)->default(0);
            $table->decimal('harga_modal',19,2)->default(0);
            $table->decimal('berat_kg', 7,2)->nullable();
            $table->longText('deskripsi')->nullable();
            $table->boolean('istersedia')->default(true);
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
