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
    protected $fillable = ['cliente_id', 'usuario_id', 'programacion_fecha_id', 'lugar_salida_tours_id', 'total', 'esAgencia', 'comisionAgencia', 'descuento', 'costoAdicional', 'costoAdicionalMotivo', 'observaciones', 'estado'];


    public function ProgramacionFecha()
    {
        return $this->belongsTo(ProgramacionFechas::class,  'programacion_fecha_id');
    }

    public function LugarSalidaTour()
    {
        return $this->belongsTo(LugarSalidaTour::class,  'lugar_salida_tours_id');
    }


    public function ClienteTitular()
    {
        return $this->belongsTo(Clientes::class,  'cliente_id');
    }




    public function DetallesReservas()
    {
        return $this->hasMany(DetallesReservas::class,  'reserva_id', 'id');
    }


    public function Abonos()
    {
        return $this->hasMany(Abonos::class,  'reserva_id', 'id');
    }

    public function HabitacionesReservas()
    {
        return $this->hasMany(HabitacionReservas::class,  'reserva_id', 'id');
    }
}
