<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataGuruTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data_guru', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->string('nip');
            $table->string('nuptk');
            $table->enum('jenis_kelamin', ['L', 'P']);
            $table->string('jabatan');
            $table->string('pangkat_gol')->nullable();
            $table->string('pangkat_tmt')->nullable();
            $table->string('pendidikan_jenjang');
            $table->string('pendidikan_jurusan');
            $table->string('tempat');
            $table->date('tanggal_lahir');
            $table->text('alamat');
            $table->string('no_hp', 20);
            $table->string('tmt_kgb')->nullable();
            $table->string('ket')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('data_guru');
    }
}
