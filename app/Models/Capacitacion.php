<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Capacitacion extends Model
{
    use HasFactory;
    
    protected $table = 'capacitaciones';
    protected $primaryKey = 'idCapacitacion';
    const UPDATED_AT = null;
    #const CREATED_AT = null;
    protected $fillable = [
        'cCapacitacion',
        'cLugar',
        'cDescripcion',
        'dCapacitacion',
        'idUsrAlta',
        'cEstatus',
        'cTipo',
        'cExt',
        'cLink',
        'cMultimedia'
    ];
}
