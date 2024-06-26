<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experimento extends Model
{
    use HasFactory;
    
    protected $table = 'experimentos';
    protected $primaryKey = 'idExperimento';
    const UPDATED_AT = null;
    #const CREATED_AT = null;
    protected $fillable = [
        'cExperimento',
        'nExperimento',
        'idProyecto',
        'dInicio',
        'dFin',
        'idUsrAlta',
        'cEstatus',
        'cNotas'
    ];
}
