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
        Schema::create('bimbingans', function (Blueprint $table) {
            $table->id('id_bimbingan');
            $table->unsignedBigInteger('id_mhs');
            $table->foreign('id_mhs')->references('id_mhs')->on('mahasiswas');
            $table->date('tanggal_bimbingan');
            $table->text('bimbingan');
            $table->text('pesan_mhs');
            $table->text('pesan_dosen')->nullable();
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
        Schema::dropIfExists('bimbingans');
    }
};
