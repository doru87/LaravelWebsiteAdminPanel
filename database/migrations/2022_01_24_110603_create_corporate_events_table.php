<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCorporateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('corporate_events', function (Blueprint $table) {
            $table->id();
            $table->string('nume');
            $table->string('slug');
            $table->longText('descriere');
            $table->string('tip_activitate');
            $table->string('durata');
            $table->string('destinatie');
            $table->string('capacitate');
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
        Schema::dropIfExists('corporate_events');
    }
}
