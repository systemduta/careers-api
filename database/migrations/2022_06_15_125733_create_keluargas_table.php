<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKeluargasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('keluargas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('full_id');
            $table->string('hubungan');
            $table->string('nama_kel');
            $table->string('pendidikan_kel');
            $table->string('pekerjaan_kel');
            $table->timestamps();

            $table->foreign('full_id')->references('id')->on('fulltimes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keluargas');
    }
}
