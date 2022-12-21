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
        Schema::create('reservas', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cliente_id')->unsigned();
            $table->integer('usuario_id')->unsigned();
            $table->integer('programacion_fecha_id')->unsigned();
            $table->integer('lugar_salida_tours_id')->unsigned();
            $table->float('total');
            $table->boolean('esAgencia');
            $table->float('comisionAgencia')->nullable();
            $table->float('descuento')->nullable();
            $table->float('costoAdicional')->nullable();
            $table->string('costoAdicionalMotivo', 500)->nullable();
            $table->string('observaciones')->nullable();
            $table->boolean('estado');
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->foreign('usuario_id')->references('id')->on('usuarios');
            $table->foreign('programacion_fecha_id')->references('id')->on('programacion_fechas');
            $table->foreign('lugar_salida_tours_id')->references('id')->on('lugar_salida_tours');

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
        Schema::dropIfExists('reservas');
    }
};
