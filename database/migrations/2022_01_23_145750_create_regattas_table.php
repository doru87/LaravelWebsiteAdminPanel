<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRegattasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('regattas', function (Blueprint $table) {
            $table->id();
            $table->string('nume');
            $table->string('slug');
            $table->longText('descriere');
            $table->string('nivel_performanta');
            $table->string('model');
            $table->year('an_fabricatie');
            $table->string('pret');
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
        Schema::dropIfExists('season_regattas');
    }
}
