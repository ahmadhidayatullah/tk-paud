<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKontrolTamanPenitipanAnakTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kontrol_taman_penitipan_anak', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('data_siswa_id');
            $table->datetime('waktu');
            $table->integer('keterlambatan_jemput')->default(0);
            $table->integer('denda')->default(0);
            $table->timestamps();

            $table->foreign('data_siswa_id')->references('id')->on('data_siswa')->onDelete('cascade');;
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kontrol_taman_penitipan_anak');
    }
}
