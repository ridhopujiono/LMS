<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class PenilaianSespimmen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penilaian_sespimmen', function (Blueprint $table) {
            $table->id();
            $table->integer('id_serdik');
            $table->string('nama_serdik');
            $table->integer('id_pokjar');
            $table->integer('id_matkul')->unique();
            $table->string('nama_matkul');
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
