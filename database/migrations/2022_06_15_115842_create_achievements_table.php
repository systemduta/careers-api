<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAchievementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('achievements', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fulltime_id')->nullable();
            $table->unsignedBigInteger('internship_id')->nullable();
            $table->string('name');
            $table->string('champion');
            $table->string('scope');
            $table->string('year');
            $table->timestamps();

            $table->foreign('fulltime_id')->references('id')->on('fulltimes');
            $table->foreign('internship_id')->references('id')->on('internships');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('achievements');
    }
}
