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
        Schema::create('abonos', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('reserva_id')->unsigned();
            $table->integer('banco_id')->unsigned();
            $table->integer('tipo_transaccion_id')->unsigned();
            $table->float('valor');
            $table->date('fecha')->nullable();
            $table->string('observacion', 600)->nullable();
            $table->string('numerodeposito', 600)->nullable();
            $table->boolean('estado');

            $table->foreign('reserva_id')->references('id')->on('reservas');
            $table->foreign('banco_id')->references('id')->on('bancos');
            $table->foreign('tipo_transaccion_id')->references('id')->on('tipo_transacciones');
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
        Schema::dropIfExists('abonos');
    }
};
