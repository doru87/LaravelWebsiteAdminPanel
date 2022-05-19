<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCustomEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('custom_events', function (Blueprint $table) {
            $table->id();
            $table->string('nume');
            $table->string('slug');
            $table->string('destinatie');
            $table->longText('descriere');
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
        Schema::dropIfExists('custom_events');
    }
}
