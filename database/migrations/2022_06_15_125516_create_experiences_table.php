<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExperiencesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('experiences', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('full_id');
            $table->string('perusahaan');
            $table->string('posisi_k');
            $table->string('periode_k');
            $table->string('gaji_k');
            $table->string('resign_k');
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
        Schema::dropIfExists('experiences');
    }
}
