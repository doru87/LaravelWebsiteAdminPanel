<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCalendarRegattasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('calendar_regattas', function (Blueprint $table) {
            $table->id();
            $table->string('nume');
            $table->string('slug');
            $table->string('perioada');
            $table->string('locatie');
            $table->date('inceput_perioada');
            $table->date('final_perioada');
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
        Schema::dropIfExists('calendar_regattas');
    }
}
