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
        Schema::create('konsumens', function (Blueprint $table) {
            $table->id();
            $table->string('nama', 25);
            $table->enum('jeniskelamin',['laki laki','perempuan']);
            $table->string('nohp',15)->unique();
            $table->string('email', 80)->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password',65);
            $table->string('avatar', 65)->nullable();
            $table->string('provinsi',30)->nullable();
            $table->string('kota',30)->nullable();
            $table->string('kecamatan',30)->nullable();
            $table->longText('alamat')->nullable();
            $table->longText('patokan')->nullable();
            $table->string('kodepos', 7)->nullable();
            $table->string('lat',20)->nullable();
            $table->string('long',20)->nullable();
            $table->rememberToken();
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
        Schema::dropIfExists('konsumens');
    }
};
