<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAbsenPulangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('absen_pulangs', function (Blueprint $table) {
            $table->increments('num');
            $table->bigInteger('absen_nip')->unsigned();
            $table->boolean('is_absen_pulang');
            $table->timestamp('absen_pulang_time');
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
        Schema::dropIfExists('absen_pulangs');
    }
}
