<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diaries', function (Blueprint $table) {
            $table->id();
            // $table->unsignedBigInteger('custom_event_id');
            // $table->foreign('custom_event_id')->references('id')->on('custom_events')->onDelete('cascade');
            $table->string('nume_eveniment');
            $table->string('slug');
            $table->longText('descriere');
            $table->string('perioada');
            $table->date('inceput_perioada');
            $table->date('final_perioada');
            $table->string('itinerariu');
            $table->string('imagine');
            $table->integer('pozitie');
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
        Schema::dropIfExists('diaries');
    }
}
