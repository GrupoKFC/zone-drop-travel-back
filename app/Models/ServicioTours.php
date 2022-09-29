<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ServicioTours extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'servicio_tours';
    protected $dates = ['deleted_at'];
    protected $fillable = ['servicio_id', 'tour_id', 'incluye', 'estado'];
}
