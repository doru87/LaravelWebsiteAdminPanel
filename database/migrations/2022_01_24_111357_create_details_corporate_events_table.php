<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailsCorporateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details_corporate_events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('corporate_event_id');
            $table->foreign('corporate_event_id')->references('id')->on('corporate_events')->onDelete('cascade');
            $table->json('imagini');
            $table->longText('servicii_incluse');
            $table->longText('servicii_optionale');
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
        Schema::dropIfExists('details_corporate_events');
    }
}
