<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Asistencia extends Model
{
    use HasFactory;
    protected $fillable = [
        'descripcion',
        'latitud',
        'longitud',
        'url',
        'taller_id',
        'cliente_id',
        'cobro_id',
        'tecnico_id',
        'servicio_id',
        
    ];


}