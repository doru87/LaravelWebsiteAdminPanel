<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailsBoatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details_boats', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('boat_id');
            $table->foreign('boat_id')->references('id')->on('boats');
            $table->longText('descriere');
            $table->integer('wc_dus');
            $table->integer('lungime');
            $table->json('imagini')->nullable();
            $table->longText('dotari_punte_cockpit');
            $table->longText('dotari_bucatarie_salon');
            $table->longText('dotari_cabine');
            $table->longText('echipament_navigatie');
            $table->longText('echipament_siguranta');
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
        Schema::dropIfExists('details_boats');
    }
}
