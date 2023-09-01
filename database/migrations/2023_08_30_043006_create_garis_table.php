<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGarisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('garis', function (Blueprint $table) {
            $table->id();
            $table->string('keterangan');
            $table->float('lat_awal', 18, 15);
            $table->float('long_awal', 18, 15);
            $table->float('lat_akhir', 18, 15);
            $table->float('long_akhir', 18, 15);
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
        Schema::dropIfExists('garis');
    }
}
