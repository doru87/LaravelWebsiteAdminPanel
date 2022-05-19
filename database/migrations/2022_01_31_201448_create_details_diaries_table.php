<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailsDiariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details_diaries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('diary_id');
            $table->foreign('diary_id')->references('id')->on('diaries')->onDelete('cascade');
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
        Schema::dropIfExists('details_diaries');
    }
}
