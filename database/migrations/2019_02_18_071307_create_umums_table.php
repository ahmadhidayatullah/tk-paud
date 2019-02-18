<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUmumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('umums', function (Blueprint $table) {
            $table->increments('id');
            $table->string('kepsek');
            $table->string('a1');
            $table->string('a2');
            $table->string('b1');
            $table->string('b2');
            $table->string('b3');
            $table->string('b4');
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
        Schema::dropIfExists('umums');
    }
}
