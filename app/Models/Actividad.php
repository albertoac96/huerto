<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Actividad extends Model
{
    use HasFactory;

    protected $table = 'actividades';
    protected $primaryKey = 'idActividad';
    const UPDATED_AT = null;
    #const CREATED_AT = null;
    protected $fillable = [
        'cActividad',
        'cLugar',
        'cDescripcion',
        'dActividad',
        'idUsrAlta',
        'cEstatus',
        'cExt',
        'cLink'
    ];
    
}
