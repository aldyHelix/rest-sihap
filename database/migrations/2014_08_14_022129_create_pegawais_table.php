<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePegawaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    //database filename changing for priority execute
    public function up()
    {
        Schema::create('pegawais', function (Blueprint $table) {
            $table->increments('id');
            $table->bigInteger('nip')->unsigned();
            $table->string('nama',100);
            $table->string('gelar_depan',100)->nullable();
            $table->string('gelar_belakang',100)->nullable();
            $table->integer('jabatan_id')->unsigned()->nullable();
            $table->integer('unitkerja_id')->unsigned()->nullable();
            $table->integer('golongan_id')->unsigned()->nullable();
            $table->bigInteger('atasan_nip')->unsigned()->nullable();
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
        Schema::dropIfExists('pegawais');
    }
}
