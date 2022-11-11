<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TipoAcompanantes;


class TipoAcompañantesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $tip   = new TipoAcompanantes();
        $tip->descripcion = "Adultos";
        $tip->estado = true;
        $tip->save();

        $tip1   = new TipoAcompanantes();
        $tip1->descripcion = "Tercera Edad";
        $tip1->estado = true;
        $tip1->save();

        $tip2   = new TipoAcompanantes();
        $tip2->descripcion = "Niños";
        $tip2->estado = true;
        $tip2->save();

        $tip3   = new TipoAcompanantes();
        $tip3->descripcion = "Infantes";
        $tip3->estado = true;
        $tip3->save();
    }
}
