<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Abonos extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'abonos';
    protected $dates = ['deleted_at'];
    protected $fillable = ['reserva_id', 'banco_id', 'tipo_transaccion_id', 'valor', 'fecha', 'observacion', 'numerodeposito', 'estado'];
}
