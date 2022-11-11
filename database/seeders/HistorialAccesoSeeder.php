<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\HistorialAccesos;

class HistorialAccesoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $hist   = new HistorialAccesos();
        $hist->usuario_id = 1;
        $hist->nick = "admin";
        $hist->pass = "admin";
        $hist->fecha =  "2022-11-11";
        $hist->estado = true;
        $hist->save();
    }
}
