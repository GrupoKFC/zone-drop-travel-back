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
            $table->integer('cliente_id')->unsigned();
            // Nuevo
            $table->integer('lugar_salida_tours_id')->nullable(); // ->unsigned();

            $table->boolean('precioDefault')->nullable();
            $table->float('precio')->nullable();
            $table->string('observaciones', 1000)->nullable();
            $table->boolean('estado');
            $table->enum("tipo_cliente", ["Titular", "Acompañante"]);

            $table->foreign('reserva_id')->references('id')->on('reservas');
            $table->foreign('costo_tour_id')->references('id')->on('costo_tours');
            $table->foreign('cliente_id')->references('id')->on('clientes');

            // Nuevo
            //   $table->foreign('lugar_salida_tours_id')->references('id')->on('lugar_salida_tours');

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
