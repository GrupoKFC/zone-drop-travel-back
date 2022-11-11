<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CostoTour extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'costo_tours';
    protected $dates = ['deleted_at'];
    protected $fillable = ['programacion_fecha_id', 'tipo_acompanante_id', 'aplicapago', 'precio', 'estado'];

    public function TipoAcompañante()
    {
        return $this->belongsTo(TipoAcompanantes::class,  'tipo_acompanante_id');
    }
}
