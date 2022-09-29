<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Servicios extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'servicios';
    protected $dates = ['deleted_at'];
    protected $fillable = ['icono', 'descripcion', 'estado'];
}
