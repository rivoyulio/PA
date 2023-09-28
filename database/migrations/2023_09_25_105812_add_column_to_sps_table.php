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
        Schema::table('sps', function (Blueprint $table) {
            $table->unsignedBigInteger('id_mhs');
            $table->unsignedBigInteger('id_semester');
            $table->integer('alfa');
            $table->string('surat');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sps', function (Blueprint $table) {
            
        });
    }
};
