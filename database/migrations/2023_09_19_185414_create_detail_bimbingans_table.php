<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('detail_bimbingans', function (Blueprint $table) {
            $table->id('id_detail_bimbingan');
            $table->unsignedBigInteger('id_bimbingan');
            $table->string('message');
            $table->unsignedBigInteger('id_mhs');
            $table->unsignedInteger('id_dsn');
            $table->enum('status', ['open', 'closed'])->defaul('open');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('detail_bimbingans');
    }
};
