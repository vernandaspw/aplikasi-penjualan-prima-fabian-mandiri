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
        Schema::create('transaksi_kategoris', function (Blueprint $table) {
            $table->id();
            $table->foreignId('transaksi_jenis_id')->nullable()->constrained('transaksi_jenis')->onUpdate('cascade')->onDelete('set null');
            $table->string('nama',30)->nullable();
            $table->boolean('isaktif')->default(true);
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
        Schema::dropIfExists('transaksi_kategoris');
    }
};
