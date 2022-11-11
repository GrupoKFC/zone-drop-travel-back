<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Bancos;

class BancosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $banc   = new Bancos();
        $banc->descripcion = "- SELECCIONE -";
        $banc->estado = true;
        $banc->default = 1;
        $banc->save();


        $banc2   = new Bancos();
        $banc2->descripcion = "PICHINCHA";
        $banc2->estado = true;
        $banc2->default = 0;
        $banc2->save();

        $banc3   = new Bancos();
        $banc3->descripcion = "PRODUBANCO";
        $banc3->estado = true;
        $banc3->default = 0;
        $banc3->save();


        $banc4   = new Bancos();
        $banc4->descripcion = "INTERNACIONAL";
        $banc4->estado = true;
        $banc4->default = 0;
        $banc4->save();


        $banc4   = new Bancos();
        $banc4->descripcion = "PACIFICO";
        $banc4->estado = true;
        $banc4->default = 0;
        $banc4->save();


        $banc5   = new Bancos();
        $banc5->descripcion = "GUAYAQUIL";
        $banc5->estado = true;
        $banc5->default = 0;
        $banc5->save();

        $banc6   = new Bancos();
        $banc6->descripcion = "BOLIVARIANO";
        $banc6->estado = true;
        $banc6->default = 0;
        $banc6->save();
    }
}
