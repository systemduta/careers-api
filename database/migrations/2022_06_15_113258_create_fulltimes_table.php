<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFulltimesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fulltimes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('recruitment_id');
            $table->string('name');
            $table->string('place_birth');
            $table->date('date_birth');
            $table->string('gender');
            $table->integer('age');
            $table->string('address_domicili');
            $table->string('address_ktp');
            $table->string('nik');
            $table->string('email');
            $table->string('religion');
            $table->string('status');
            $table->string('blood');
            $table->string('gaji');
            $table->string('pt');
            $table->string('jurusan');
            $table->string('years');
            $table->string('ipk');
            $table->string('cv');
            $table->string('portofolio');
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
        Schema::dropIfExists('fulltimes');
    }
}
