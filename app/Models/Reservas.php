<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Reservas extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'reservas';
    protected $dates = ['deleted_at'];
    protected $fillable = ['cliente_id', 'usuario_id', 'programacion_fecha_id', 'total', 'esAgencia', 'comisionAgencia', 'descuento', 'observaciones', 'estado'];
}
