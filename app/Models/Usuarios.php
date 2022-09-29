<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usuarios extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'usuarios';
    protected $dates = ['deleted_at'];
    protected $fillable = ['rol_id', 'documento', 'tipoDocumento', 'nombres', 'apellidos', 'fechaNacimiento', 'correo', 'direccion', 'genero', 'estado'];
}
