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
    protected $fillable = ['reserva_id', 'costo_tour_id', 'cliente_id', 'lugar_salida_tours_id', 'precioDefault', 'precio', 'observaciones', 'estado', 'tipo_cliente'];

    public function Cliente()
    {
        return $this->belongsTo(Clientes::class,  'cliente_id');
    }

    public function CostoTour()
    {
        return $this->belongsTo(CostoTour::class,  'costo_tour_id');
    }



    public function LugarSalidaTour()
    {
        return $this->belongsTo(LugarSalidaTour::class,  'lugar_salida_tours_id');
    }
}
