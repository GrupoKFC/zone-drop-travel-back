<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LugaresSalidas extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $table = 'lugares_salidas';
    protected $dates = ['deleted_at'];
    protected $fillable = ['descripcion', 'estado'];
}
