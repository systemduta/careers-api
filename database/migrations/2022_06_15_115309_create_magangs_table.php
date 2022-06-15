<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMagangsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('magangs', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('intern_id');
            $table->string('nama_ma');
            $table->string('posisi_ma');
            $table->string('periode_ma');
            $table->string('achievement_ma');
            $table->string('benefit_ma')->nullable();
            $table->timestamps();

            $table->foreign('intern_id')->references('id')->on('internships');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('magangs');
    }
}
