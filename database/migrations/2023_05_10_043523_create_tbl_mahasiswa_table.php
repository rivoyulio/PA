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
        Schema::create('mahasiswas', function (Blueprint $table) {
            $table->id('id_mhs');
            $table->string('nim');
            $table->timestamp('nim_verified_at')->nullable();
            $table->string('nama_mhs');
            $table->string('nama_panggilan')->nullable();
            $table->string('tempat_lahir')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->unsignedBigInteger('id_agama')->nullable();
            $table->string('jekel')->nullable();
            $table->string('jmlh_saudara')->nullable();
            $table->string('anak_ke')->nullable();
            $table->string('no_hp')->nullable();
            $table->unsignedBigInteger('id_prodi');
            $table->string('password');
            $table->unsignedBigInteger('id_kelas')->nullable();
            $table->string('fotomhs')->nullable();
            $table->string('provinsi')->nullable();
            $table->string('kabupaten')->nullable();
            $table->string('kecamatan')->nullable();
            $table->string('alamat_mhs')->nullable();
            $table->string('nama_sekolah')->nullable();
            $table->string('jurusan')->nullable();
            $table->string('alamat_sekolah')->nullable();
            $table->string('prestasi')->nullable();
            $table->string('nama_ortu')->nullable();
            $table->string('alamat_ortu')->nullable();
            $table->string('pekerjaan_ortu')->nullable();
            $table->string('nohp_ortu')->nullable();
            $table->string('nama_wali')->nullable();
            $table->string('alamat_wali')->nullable();
            $table->string('pekerjaan_wali')->nullable();
            $table->string('nohp_wali')->nullable();
            $table->string('status_biodata')->nullable();
            $table->foreign('id_agama')->references('id_agama')->on('agamas');
            $table->foreign('id_prodi')->references('id_prodi')->on('prodis');
            $table->foreign('id_kelas')->references('id_kelas')->on('kelas');
            $table->rememberToken();
            $table->timestamps();
            $table->softDeletes('deleted_at', 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mahasiswas');
    }
};
