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
        Schema::create('habitacion_reservas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('habitacion_id')->unsigned();
            $table->integer('reserva_id')->unsigned();
            $table->integer('cantidad')->nullable();
            $table->string('observaciones', 2000)->nullable();
            $table->boolean('estado');

            $table->foreign('habitacion_id')->references('id')->on('habitaciones');
            $table->foreign('reserva_id')->references('id')->on('reservas');
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
        Schema::dropIfExists('habitacion_reservas');
    }
};
