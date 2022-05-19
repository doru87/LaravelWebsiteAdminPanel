<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarSeasonRegattasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendar_season_regattas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('regatta_id');
            $table->foreign('regatta_id')->references('id')->on('regattas')->onDelete('cascade');
            $table->string('nume');
            $table->string('slug');
            $table->string('perioada');
            $table->string('locatie');
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
        Schema::dropIfExists('calendar_season_regattas');
    }
}
