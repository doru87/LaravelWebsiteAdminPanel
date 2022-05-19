<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChartersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('charters', function (Blueprint $table) {
            $table->id();
            $table->string('nume');
            $table->string('slug');
            $table->longText('descriere');
            $table->string('perioada');
            $table->string('capacitate');
            $table->string('skipper')->nullable();
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
        Schema::dropIfExists('charters');
    }
    
}
