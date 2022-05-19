<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailsChartersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details_charters', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('charter_id');
            $table->foreign('charter_id')->references('id')->on('charters')->onDelete('cascade');
            $table->json('imagini');
            $table->longText('servicii_incluse');
            // $table->date('check_in');
            // $table->date('check_out');
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
        Schema::dropIfExists('details_charters');
    }
}
