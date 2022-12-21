<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HabitacionReservas extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'habitacion_reservas';
    protected $dates = ['deleted_at'];
    protected $fillable = ['habitacion_id', 'reserva_id', 'cantidad', 'observaciones', 'estado'];


    public function Habitacion()
    {
        return $this->belongsTo(Habitaciones::class,  'habitacion_id');
    }
}
