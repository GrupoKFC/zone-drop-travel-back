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
        Schema::create('programacion_fechas', function (Blueprint $table) {
            $table->increments('id');
            $table->date('fecha');
            $table->boolean('estado');
            $table->string('observacion', 1000)->nullable();
            $table->integer('tour_id')->unsigned();
            $table->foreign('tour_id')->references('id')->on("tours");
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
        Schema::dropIfExists('programacion_fechas');
    }
};
