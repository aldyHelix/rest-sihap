<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePenilaiansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaians', function (Blueprint $table) {
            $table->increments('penilaian_id');
            $table->bigInteger('peg_nip')->unsigned();
            $table->bigInteger('penilai_nip')->unsigned();
            $table->integer('nilai_pelayanan')->default('0');
            $table->integer('nilai_integritas')->default('0');
            $table->integer('nilai_komitmen')->default('0');
            $table->integer('nilai_disiplin')->default('0');
            $table->integer('nilai_kerjasama')->default('0');
            $table->integer('nilai_kepemimpinan')->default('0');
            $table->boolean('is_kirim')->default('0');
            $table->date('date_kirim')->nullable();
            $table->boolean('is_persetujuan')->default('0');
            $table->date('date_persetujuan')->nullable();
            $table->integer('total_penilaian')->nullable();
            $table->year('penilaian_year');
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
        Schema::dropIfExists('penilaians');
    }
}
