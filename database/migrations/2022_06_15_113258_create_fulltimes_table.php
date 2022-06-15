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
            $table->unsignedBigInteger('participant_id');
            $table->integer('age');
            $table->string('address_ktp');
            $table->string('religion');
            $table->string('status');
            $table->string('blood');
            $table->string('gaji');
            $table->string('bb');
            $table->string('suku');
            

            // Apakah Anda pernah melamar di perusahaan ini sebelumnya. Kapan & sebagai apa ? 
            $table->string('others_1');
            // Apakah saat ini Anda melamar di perusahaan lain? Sebagai posisi apa ?
            $table->string('others_2');
            // Apakah Anda berhijab (Khusus Wanita)
            $table->string('others_3');
            // Apa Anda memiliki sosmed ? (FB, IG, / apa)
            $table->string('others_4');
            // Apakah Anda pernah mengalami kecelakaan? Bila ya kapan dan apa akibat yang anda rasakan sekarang ?
            $table->string('others_5');
            // Apakah Anda pernah berurusan dengan polisi karena tindakan tertentu ?
            $table->string('others_6');
            // Bila diterima bersediakah Anda bertugas ke luar kota ?
            $table->string('others_7');
            // Pernahkan Anda memenangkan sebuah kejuaraan ?Jika Pernah Sebutkan ?
            $table->string('others_8');
            // Kenapa Anda ingin berkerja di Maesa Group Holding Company ?
            $table->string('others_9');
            // Kenapa menginginkan posisi yang sedang Anda lamar ?
            $table->string('others_10');
            // Kelebihan apa yang anda miliki untuk mengisi posisi tersebut ?
            $table->string('others_11');

            $table->text('skill');

            $table->timestamps();
            $table->foreign('participant_id')->references('id')->on('participants');
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
