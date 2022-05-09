<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Serdik extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('serdik_sespimmen', function (Blueprint $table) {
            $table->id();
            $table->string('nama_serdik');
            $table->string('username')->unique();
            $table->string('pangkat')->nullable();
            $table->string('kode')->nullable();
            $table->string('foto')->nullable();
            $table->string('jabatan')->nullable();
            $table->string('lp')->nullable();
            $table->string('no_telp')->nullable();
            $table->string('pokjar')->nullable();
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
