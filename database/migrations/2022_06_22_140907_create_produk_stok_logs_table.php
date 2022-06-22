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
        Schema::create('produk_stok_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produk_stok_id')->constrained('produk_stoks')->onUpdate('cascade')->onDelete('cascade');
            $table->enum('jenis',['masuk','keluar']);
            $table->bigInteger('po')->default(0);
            $table->bigInteger('real')->default(0);
            $table->longText('keterangan')->nullable();
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
        Schema::dropIfExists('produk_stok_logs');
    }
};
