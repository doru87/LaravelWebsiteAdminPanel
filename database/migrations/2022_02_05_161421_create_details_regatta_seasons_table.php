<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailsRegattaSeasonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details_regatta_seasons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('regatta_season_id');
            $table->foreign('regatta_season_id')->references('id')->on('regatta_seasons')->onDelete('cascade');
            $table->date('inceput_sezon');
            $table->date('final_sezon');
            $table->json('imagini');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('details_regatta_seasons');
    }
}
