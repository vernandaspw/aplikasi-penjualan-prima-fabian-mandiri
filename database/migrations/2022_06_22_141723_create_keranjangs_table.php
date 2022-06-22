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
        Schema::create('keranjangs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('konsumen_id')->nullable()->constrained('konsumens')->onUpdate('cascade')->onDelete('set null');
            $table->foreignId('pegawai_id')->nullable()->constrained('pegawais')->onUpdate('cascade')->onDelete('set null');
            $table->decimal('total_belanja',19,2)->default(0);
            $table->decimal('total_modal',19,2)->default(0);
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
        Schema::dropIfExists('keranjangs');
    }
};
