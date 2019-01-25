<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePembayaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->increments('id');
            $table->enum('jenis_pembayaran', ['bulanan', 'pangkal', 'pendaftaran', 'seragam']);
            $table->unsignedInteger('data_siswa_id');
            $table->date('tanggal');
            $table->integer('bayar');
            $table->integer('total_denda')->default(0);
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
        Schema::dropIfExists('pembayaran');
    }
}
