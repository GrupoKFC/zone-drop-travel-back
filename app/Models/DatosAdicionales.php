<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DatosAdicionales extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'datos_adicionales';
    protected $dates = ['deleted_at'];
    protected $fillable = ['cliente_id', 'descripcion', 'valor', 'estado'];
}
