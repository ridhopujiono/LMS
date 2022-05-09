<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RekapPenilaian extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rekap_penilaian_sespimmen', function (Blueprint $table) {
            $table->id();
            $table->integer('id_serdik')->unique();
            $table->string('nama_serdik');
            $table->integer('id_pokjar');
            $table->integer('total_matkul');
            $table->float('nilai');
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
