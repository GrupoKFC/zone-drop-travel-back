<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Usuarios;

class UsuarioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        //   ,  , genero, estado, created_at, updated_at, deleted_at
        $tip   = new Usuarios();
        $tip->rol_id =  1;
        $tip->documento = "1234567890";
        $tip->tipoDocumento =  "cedula";
        $tip->nombres =  "Administrador";
        $tip->apellidos =  "Sistema";
        $tip->fechaNacimiento =  "1992-03-27";
        $tip->correo =  "desarrollos16@hotmail.com";
        $tip->direccion =  "Quito - 6 Diciembre";
        $tip->genero =  "Masculino";
        $tip->estado =  true;
        $tip->save();
    }
}
