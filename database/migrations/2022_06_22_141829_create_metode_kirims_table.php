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
        Schema::create('metode_kirims', function (Blueprint $table) {
            $table->id();
            $table->enum('metode',['logistik perusahaan','logistik lainnya','ambil ditempat']);
            $table->string('nama',35)->nullable();
            $table->decimal('biaya',10,2)->default(0);
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
        Schema::dropIfExists('metode_kirims');
    }
};
