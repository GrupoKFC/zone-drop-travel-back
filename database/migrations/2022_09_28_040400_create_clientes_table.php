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
        Schema::create('clientes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('documento', '20');
            $table->string('tipoDocumento', '50');
            $table->string('nombres', '100');
            $table->string('apellidos', '100');
            $table->date('fechaNacimiento');
            $table->string('correo', '100')->unique();
            $table->string('direccion', '500');
            $table->enum("genero", ["Masculino", "Femenino", "Otro"]);
            $table->string('telefono1', '20');
            $table->string('telefono2', '20');
            $table->string('telefono3', '20');
            $table->string('observaciones', '500');
            $table->boolean('estado');
            $table->softDeletes();
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
        Schema::dropIfExists('clientes');
    }
};
