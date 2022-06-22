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
        Schema::create('produk_stoks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('produk_id')->constrained('produks')->onUpdate('cascade')->onDelete('cascade');
            $table->string('satuan_unit', 15);
            $table->bigInteger('po')->default(0);
            $table->bigInteger('real')->default(0);
            $table->integer('stok_minimum')->default(0);
            $table->boolean('isstok')->default(true);
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
        Schema::dropIfExists('produk_stoks');
    }
};
