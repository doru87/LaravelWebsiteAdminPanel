<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailsRegattasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details_regattas', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('regatta_id');
            $table->foreign('regatta_id')->references('id')->on('regattas')->onDelete('cascade');
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
        Schema::dropIfExists('details_seasons_regattas');
    }
}
