<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailsCustomEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('details_custom_events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('custom_event_id');
            $table->foreign('custom_event_id')->references('id')->on('custom_events')->onDelete('cascade');
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
        Schema::dropIfExists('details_custom_events');
    }
}
