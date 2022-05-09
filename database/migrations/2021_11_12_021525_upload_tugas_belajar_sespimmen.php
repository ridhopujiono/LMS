<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UploadTugasBelajarSespimmen extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('upload_tugas_belajar_sespimmen', function (Blueprint $table) {
            $table->id();
            $table->integer('id_tugas');
            $table->integer('id_serdik');
            $table->string('nama_serdik');
            $table->string('no_serdik');
            $table->integer('pokjar');
            $table->string('file');
            $table->integer('nilai');
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
