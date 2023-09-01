<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKoordPolygonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('koord_polygons', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('refPolygon_id');
            $table->foreign('refPolygon_id')->references('id')->on('ref_polygons');
            $table->float('latitude', 18, 15);
            $table->float('longitude', 18, 15);
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
        Schema::dropIfExists('koord_polygons');
    }
}
