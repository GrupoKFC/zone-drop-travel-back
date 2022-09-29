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
        Schema::create('costo_tours', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('programacion_fecha_id')->unsigned();
            $table->integer('tipo_acompanante_id')->unsigned();
            $table->boolean('aplicapago');
            $table->float('precio');
            $table->boolean('estado');
            $table->foreign('programacion_fecha_id')->references('id')->on('programacion_fechas');
            $table->foreign('tipo_acompanante_id')->references('id')->on('tipo_acompanantes');
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
        Schema::dropIfExists('costo_tours');
    }
};
