<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LugarSalidaTour extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'lugar_salida_tours';
    protected $dates = ['deleted_at'];
    protected $fillable = ['lugar_salida_id', 'tour_id', 'hora', 'siguienteDia', 'estado'];

    public function LugarSalida()
    {
        return $this->belongsTo(LugaresSalidas::class,  'lugar_salida_id');
    }
}
