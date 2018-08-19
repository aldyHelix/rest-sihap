<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKegiatansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kegiatans', function (Blueprint $table) {
            $table->increments('num');
            $table->integer('kegiatan_id');
            $table->string('kegiatan_name');
            $table->text('kegiatan_desc')->nullable();
            $table->string('kegiatan_loc')->nullable();
            $table->dateTime('kegiatan_start');
            $table->dateTime('kegiatan_end');
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
        Schema::dropIfExists('kegiatans');
    }
}
