<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Tours extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'tours';
    protected $dates = ['deleted_at'];
    protected $fillable = ['titulo', 'duracion', 'detalles', 'imagen', 'incluye', 'noIncluye', 'informacionAdicional', 'estado'];


    public function programacionFechas()
    {
        return $this->hasMany(ProgramacionFechas::class, 'tour_id', 'id');
    }
    public function LugarSalidaTour()
    {
        return $this->hasMany(LugarSalidaTour::class, 'tour_id', 'id');
    }
}
