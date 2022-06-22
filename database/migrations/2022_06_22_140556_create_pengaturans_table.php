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
        Schema::create('pengaturans', function (Blueprint $table) {
            $table->id();
            $table->string('nm_perusahaan',40);
            $table->string('nm_toko',30)->nullable();
            $table->string('no_telp',15)->nullable();
            $table->string('no_wa', 15)->nullable();
            $table->string('ig',30)->nullable();
            $table->longText('tentang')->nullable();
            $table->string('provinsi',30)->nullable();
            $table->string('kota',30)->nullable();
            $table->string('kecamatan',30)->nullable();
            $table->longText('alamat')->nullable();
            $table->string('kodepos',7)->nullable();
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
        Schema::dropIfExists('pengaturans');
    }
};
