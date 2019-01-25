<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_siswa', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('nama');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('tempat');
            $table->date('tanggal_lahir');
            $table->string('pekerjaan_orang_tua');
            $table->text('alamat');
            $table->string('no_hp', 20);
            $table->unsignedInteger('jenis_biaya_siswa_id');
            $table->enum('jenis_bayar', ['cash', 'cicil']);
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('jenis_biaya_siswa_id')->references('id')->on('jenis_biaya_siswa');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_siswa');
    }
}
