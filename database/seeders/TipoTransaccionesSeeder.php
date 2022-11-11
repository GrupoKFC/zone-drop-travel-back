<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TipoTransacciones;

class TipoTransaccionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tip   = new TipoTransacciones();
        $tip->descripcion = "SELECCIONAR";
        $tip->estado = true;
        $tip->default = 0;
        $tip->save();


        $tip2   = new TipoTransacciones();
        $tip2->descripcion = "EFECTIVO";
        $tip2->estado = true;
        $tip2->default = 1;
        $tip2->save();

        $tip3   = new TipoTransacciones();
        $tip3->descripcion = "TRANSFERENCIA";
        $tip3->estado = true;
        $tip3->default = 0;
        $tip3->save();


        $tip4   = new TipoTransacciones();
        $tip4->descripcion = "DEPOSITO";
        $tip4->estado = true;
        $tip4->default = 0;
        $tip4->save();


        $tip5   = new TipoTransacciones();
        $tip5->descripcion = "CHEQUE";
        $tip5->estado = true;
        $tip5->default = 0;
        $tip5->save();
    }
}
