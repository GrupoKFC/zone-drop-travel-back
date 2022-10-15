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
        Schema::create('tours', function (Blueprint $table) {
            $table->increments('id');
            $table->string('titulo', 500);
            $table->string('duracion', 200)->nullable();
            $table->string('detalles', 400)->nullable();
            $table->string('imagen', 1000)->nullable();
            $table->string('incluye', 5000)->nullable();
            $table->string('noIncluye', 5000)->nullable();
            $table->string('informacionAdicional', 3000)->nullable();
            $table->boolean('estado');
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
        Schema::dropIfExists('tours');
    }
};
