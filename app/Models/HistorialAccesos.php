<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class HistorialAccesos extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'historial_accesos';
    protected $dates = ['deleted_at'];
    protected $fillable = ['usuario_id', 'nick', 'pass', 'fecha', 'estado'];
}
