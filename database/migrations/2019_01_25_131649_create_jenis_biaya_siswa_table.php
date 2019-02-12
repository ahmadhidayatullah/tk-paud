<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateJenisBiayaSiswaTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jenis_biaya_siswa', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nama');
            $table->integer('pendaftaran');
            $table->integer('pangkal');
            $table->integer('seragam')->default(0);
            $table->integer('bulanan');
            $table->integer('peralihan')->default(0);
            $table->integer('denda_permenit')->default(0);
            $table->string('keterangan')->nullable();
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
        Schema::dropIfExists('jenis_biaya_siswa');
    }
}
