<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrganizationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('organizations', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('internship_id')->nullable();
            $table->unsignedBigInteger('fulltime_id')->nullable();
            $table->string('name');
            $table->string('position');
            $table->string('period');
            $table->string('achievement');
            $table->timestamps();

            $table->foreign('internship_id')->references('id')->on('internships');
            $table->foreign('fulltime_id')->references('id')->on('fulltimes');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('organizations');
    }
}
