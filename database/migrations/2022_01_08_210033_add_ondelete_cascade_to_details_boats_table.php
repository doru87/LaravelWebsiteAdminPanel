<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddOndeleteCascadeToDetailsBoatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('details_boats', function (Blueprint $table) {
            $table->dropForeign('details_boats_boat_id_foreign');
            $table->foreign('boat_id')->references('id')->on('boats')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('details_boats', function (Blueprint $table) {
            //
        });
    }
}
