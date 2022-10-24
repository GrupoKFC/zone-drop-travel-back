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
        Schema::create('acompaniantes', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('cliente_id')->unsigned();

            $table->string('documento', '20')->nullable();
            $table->string('nombres', '100')->nullable();
            $table->string('apellidos', '100')->nullable();
            $table->date('fechaNacimiento')->nullable();
            $table->string('correo', '100')->nullable();
            $table->string('direccion', '500')->nullable();
            $table->enum("genero", ["Masculino", "Femenino", "Otro"])->nullable();
            $table->string('telefono1', '20')->nullable();
            $table->string('telefono2', '20')->nullable();
            $table->string('observaciones', '500')->nullable();
            $table->foreign('cliente_id')->references('id')->on('clientes');
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
        Schema::dropIfExists('acompaniantes');
    }
};
