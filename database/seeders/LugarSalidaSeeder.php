<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\LugaresSalidas;

class LugarSalidaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $lug   = new LugaresSalidas();
        $lug->descripcion = "Terminal de Carcelén";
        $lug->estado = true;
        $lug->save();

        $lug2   = new LugaresSalidas();
        $lug2->descripcion = "Tribuna de los Shirys";
        $lug2->estado = true;
        $lug2->save();

        $lug3   = new LugaresSalidas();
        $lug3->descripcion = "Entrada Carapungo, UPC.";
        $lug3->estado = true;
        $lug3->save();



        $lug4   = new LugaresSalidas();
        $lug4->descripcion = "El Trébol";
        $lug4->estado = true;
        $lug4->save();


        $lug5   = new LugaresSalidas();
        $lug5->descripcion = "Redondel Villaflora";
        $lug5->estado = true;
        $lug5->save();



        $lug6   = new LugaresSalidas();
        $lug6->descripcion = "Centro Comercial el Recreo";
        $lug6->estado = true;
        $lug6->save();

        $lug7   = new LugaresSalidas();
        $lug7->descripcion = "Centro Comercial Quinto Sur";
        $lug7->estado = true;
        $lug7->save();

        $lug8   = new LugaresSalidas();
        $lug8->descripcion = "Valle de los Chillos, Triangulo";
        $lug8->estado = true;
        $lug8->save();

        $lug9   = new LugaresSalidas();
        $lug9->descripcion = "Valle de los Chillos, Centro Comercial San Luis";
        $lug9->estado = true;
        $lug9->save();

        $lug10   = new LugaresSalidas();
        $lug10->descripcion = "Machachi entrada al Chagra";
        $lug10->estado = true;
        $lug10->save();

        // $lug11   = new LugaresSalidas();
        // $lug11->descripcion = "";
        // $lug11->estado = true;
        // $lug11->save();


        // $lug11   = new LugaresSalidas();
        // $lug11->descripcion = "";
        // $lug11->estado = true;
        // $lug11->save();

    }
}
