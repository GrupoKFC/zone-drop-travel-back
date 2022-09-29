<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Acompaniantes extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'acompaniantes';
    protected $dates = ['deleted_at'];
    protected $fillable = ['cliente_id', 'documento', 'nombres', 'apellidos', 'fechaNacimiento', 'correo', 'direccion', 'genero', 'telefono1', 'telefono2', 'observaciones'];
}
