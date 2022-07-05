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
        Schema::create('kasir_kas_kategoris', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kasir_kas_jenis_id')->nullable()->constrained('kasir_kas_jenis')->onUpdate('cascade')->onDelete('set null');
            $table->string('nama', 20);
            $table->boolean('istampil')->default(true);
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
        Schema::dropIfExists('kasir_kas_kategoris');
    }
};
