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
        Schema::create('kasir_kas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kasir_id')->constrained('kasirs')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('kasir_kas_jenis_id')->nullable()->constrained('kasir_kas_jenis')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('kasir_kas_kategori_id')->nullable()->constrained('kasir_kas_kategoris')->onUpdate('cascade')->onDelete('set null');
            $table->decimal('nominal',19,2)->default(0);
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
        Schema::dropIfExists('kasir_kas');
    }
};
