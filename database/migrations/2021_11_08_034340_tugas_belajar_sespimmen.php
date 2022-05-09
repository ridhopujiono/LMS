<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class TugasBelajarSespimmen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tugas_belajar_sespimmen', function (Blueprint $table) {
            $table->id();
            $table->integer('id_matkul');
            $table->integer('id_gadik');
            $table->string('nama_gadik');
            $table->string('file');
            $table->integer('pokjar');
            $table->date('deadline');
            $table->time('end');
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
