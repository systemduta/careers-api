<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateParticipantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('participants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('recruitment_id');
            $table->string('name');
            $table->string('place_birth');
            $table->date('date_birth');
            $table->string('gender');
            $table->string('address_domicili');
            $table->string('phone');
            $table->string('email');
            $table->string('cv');
            $table->string('portofolio');
            $table->string('sertificate');
            $table->string('foto');
            $table->text('about');
            $table->text('advantage');
            $table->text('weakness');
            $table->text('reason');
            $table->text('vision');
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
        Schema::dropIfExists('participants');
    }
}
