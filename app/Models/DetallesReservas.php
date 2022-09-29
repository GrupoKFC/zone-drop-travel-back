<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DetallesReservas extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'detalles_reservas';
    protected $dates = ['deleted_at'];
    protected $fillable = ['reserva_id', 'costo_tour_id', 'acompaniante_id', 'precioDefault', 'precio', 'observaciones', 'estado'];
}
