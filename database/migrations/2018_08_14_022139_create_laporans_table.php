<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLaporansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('laporans', function (Blueprint $table) {
            $table->increments('laporan_id');
            $table->bigInteger('peg_nip')->unsigned();
            $table->integer('penilaian_id')->unsigned();
            $table->timestamp('laporan_create_at');
            $table->boolean('is_kirim')->default('0');
            $table->date('laporan_kirim')->nullable();
            $table->boolean('is_persetujuan')->default('0');
            $table->date('laporan_persetujuan')->nullable();
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
        Schema::dropIfExists('laporans');
    }
}
