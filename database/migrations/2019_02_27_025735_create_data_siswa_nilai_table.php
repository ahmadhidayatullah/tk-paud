<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataSiswaNilaiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_siswa_nilai', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('data_siswa_id');
            $table->text('pendahuluan');
            $table->text('agama');
            $table->text('fisik_motorik');
            $table->text('sosial_emosional');
            $table->text('bahasa');
            $table->text('kognitif');
            $table->text('seni');
            $table->text('penutup');
            $table->timestamps();

            $table->foreign('data_siswa_id')->references('id')->on('data_siswa')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_siswa_nilai');
    }
}
