<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class JadwalBelajarSespimmen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('jadwal_belajar_sespimmen', function (Blueprint $table) {
            $table->id();
            $table->string('hari');
            $table->datetime('tanggal');
            $table->time('start');
            $table->time('end');
            $table->integer('id_pokjar');
            $table->string('mata_kuliah');
            $table->string('metode');
            $table->string('tempat');
            $table->longText('deskripsi');
            $table->longText('pengampu_sespimmen');
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
        //
    }
}
