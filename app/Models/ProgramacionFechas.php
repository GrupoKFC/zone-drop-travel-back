<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProgramacionFechas extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'programacion_fechas';
    protected $dates = ['deleted_at'];
    protected $fillable = ['fecha', 'estado', 'tour_id', "observacion"];



    public function Tour()
    {
        return $this->belongsTo(Tours::class,  'tour_id');
    }


    public function CostoTour()
    {
        return $this->hasMany(CostoTour::class,  'programacion_fecha_id', 'id');
    }
}
