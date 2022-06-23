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
        Schema::create('metode_kirim_pembayarans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('metode_kirim_id')->nullable()->constrained('metode_kirims')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('metode_pembayaran_id')->nullable()->constrained('metode_pembayarans')->onUpdate('cascade')->onDelete('set null');
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
        Schema::dropIfExists('metode_kirim_pembayarans');
    }
};
