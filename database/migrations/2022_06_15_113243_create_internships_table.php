<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInternshipsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('internships', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('recruitment_id');
            $table->string('name');
            $table->string('place_birth');
            $table->date('date_birth');
            $table->string('gender');
            $table->string('address_domicili');
            $table->string('email');
            $table->string('resources');
            $table->string('commitment');
            $table->string('hope');
            $table->string('ig');
            $table->string('fb');
            $table->string('twiter');
            $table->string('pt');
            $table->string('jurusan');
            $table->string('semester');
            $table->string('cv');
            $table->string('fortofolio');
            $table->string('sertificate');
            $table->string('foto');
            $table->timestamps();

            $table->foreign('recruitment_id')->references('id')->on('recruitments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('internships');
    }
}
