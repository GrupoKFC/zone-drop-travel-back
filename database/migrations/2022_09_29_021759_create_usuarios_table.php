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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('rol_id')->unsigned();

            $table->string('documento', '20');
            $table->string('tipoDocumento', '50')->nullable();
            $table->string('nombres', '100');
            $table->string('apellidos', '100');
            $table->date('fechaNacimiento')->nullable();
            $table->string('correo', '100')->unique();
            $table->string('direccion', '500')->nullable();
            $table->enum("genero", ["Masculino", "Femenino", "Otro"]);
            $table->boolean('estado');
            $table->foreign('rol_id')->references('id')->on('roles');
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
        Schema::dropIfExists('usuarios');
    }
};
