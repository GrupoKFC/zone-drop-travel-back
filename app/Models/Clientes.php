<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Clientes extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'clientes';
    protected $dates = ['deleted_at'];
    protected $fillable = ['documento', 'tipoDocumento', 'nombres', 'apellidos', 'fechaNacimiento', 'correo', 'direccion', 'genero', 'telefono1', 'telefono2', 'telefono3', 'observaciones', 'estado', 'tipo_acompanante_id'];
}
