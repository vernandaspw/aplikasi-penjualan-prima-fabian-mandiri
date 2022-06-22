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
        Schema::create('produk_ulasans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('konsumen_id')->constrained('konsumens')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('produk_id')->constrained('produks')->onUpdate('cascade')->onDelete('cascade');
            $table->decimal('rating',4,2);
            $table->longText('ulasan')->nullable();
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
        Schema::dropIfExists('produk_ulasans');
    }
};
