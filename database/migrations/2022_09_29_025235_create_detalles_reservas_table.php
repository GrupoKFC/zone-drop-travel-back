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
        Schema::create('detalles_reservas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reserva_id')->unsigned();
            $table->integer('costo_tour_id')->unsigned();
            $table->integer('acompaniante_id')->unsigned();

            $table->boolean('precioDefault')->nullable();
            $table->float('precio')->nullable();
            $table->string('observaciones', 1000)->nullable();
            $table->boolean('estado');

            $table->foreign('reserva_id')->references('id')->on('reservas');
            $table->foreign('costo_tour_id')->references('id')->on('costo_tours');
            $table->foreign('acompaniante_id')->references('id')->on('acompaniantes');
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
        Schema::dropIfExists('detalles_reservas');
    }
};
