<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateExpeditionItinerariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('expedition_itineraries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('expedition_id');
            $table->foreign('expedition_id')->references('id')->on('expeditions')->onDelete('cascade');
            $table->string('destinatie');
            $table->string('perioada');
            $table->longText('descriere');
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
        Schema::dropIfExists('expedition_itineraries');
    }
}
