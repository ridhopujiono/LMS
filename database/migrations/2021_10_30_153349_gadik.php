<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class Gadik extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gadik_sespimmen', function (Blueprint $table) {
            $table->id();
            $table->string('nama_gadik');
            $table->string('username')->unique();
            $table->string('password');
            $table->string('pangkat');
            $table->string('kode');
            $table->string('foto');
            $table->string('jabatan');
            $table->string('lp');
            $table->string('no_telp');
            $table->string('jenis_gadik');
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
