<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TipoAcompanantes extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'tipo_acompanantes';
    protected $dates = ['deleted_at'];
    protected $fillable = ['descripcion', 'estado'];
}
