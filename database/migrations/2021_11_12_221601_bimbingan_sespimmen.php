<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BimbinganSespimmen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bimbingan_sespimmen', function (Blueprint $table) {
            $table->id();
            $table->string('nama_serdik');
            $table->integer('id_serdik');
            $table->integer('id_pokjar');
            $table->string('judul_kegiatan');
            $table->string('deskripsi_kegiatan');
            $table->string('file');
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
