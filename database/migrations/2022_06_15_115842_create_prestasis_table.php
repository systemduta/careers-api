<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrestasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prestasis', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('full_id');
            $table->string('nama_p');
            $table->string('juara_p');
            $table->string('lingkup_p');
            $table->string('tahun_p');
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
        Schema::dropIfExists('prestasis');
    }
}
