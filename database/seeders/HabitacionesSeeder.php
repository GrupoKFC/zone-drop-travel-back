<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Habitaciones;

class HabitacionesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hab   = new Habitaciones();
        $hab->descripcion = "Individual";
        $hab->estado = true;
        $hab->save();

        $hab1  = new Habitaciones();
        $hab1->descripcion = "Doble";
        $hab1->estado = true;
        $hab1->save();


        $hab2   = new Habitaciones();
        $hab2->descripcion = "Tripe";
        $hab2->estado = true;
        $hab2->save();


        $hab3   = new Habitaciones();
        $hab3->descripcion = "Cuadruple";
        $hab3->estado = true;
        $hab3->save();

        $hab4   = new Habitaciones();
        $hab4->descripcion = "Quintuple";
        $hab4->estado = true;
        $hab4->save();

        $hab5   = new Habitaciones();
        $hab5->descripcion = "Suite";
        $hab5->estado = true;
        $hab5->save();

        $hab6   = new Habitaciones();
        $hab6->descripcion = "Presidencial";
        $hab6->estado = true;
        $hab6->save();
    }
}
