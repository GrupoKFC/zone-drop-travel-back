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
            $table->string('tipoDocumento', '50')->nullable();
            $table->string('nombres', '100');
            $table->string('apellidos', '100')->nullable();
            $table->date('fechaNacimiento')->nullable();
            $table->string('correo', '100')->nullable();
            $table->string('direccion', '500')->nullable();
            $table->enum("genero", ["Masculino", "Femenino", "Otro", ""])->nullable();
            $table->string('telefono1', '20')->nullable();
            $table->string('telefono2', '20')->nullable();
            $table->string('telefono3', '20')->nullable();
            $table->string('observaciones', '500')->nullable();

            // $table->integer('tipo_acompanante_id')->nullable();
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
