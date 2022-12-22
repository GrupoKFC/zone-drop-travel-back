<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('lugar_salida_tours', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('lugar_salida_id')->unsigned();
            $table->integer('tour_id')->unsigned();
            $table->string('hora', 15);
            $table->boolean('siguienteDia')->nullable();
            $table->boolean('estado');
            $table->foreign('lugar_salida_id')->references('id')->on('lugares_salidas');
            $table->foreign('tour_id')->references('id')->on('tours');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('lugar_salida_tours');
    }
};
