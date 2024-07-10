<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    use HasFactory;
    
    protected $table = 'proyectos';
    protected $primaryKey = 'idProyecto';
    const UPDATED_AT = null;
    #const CREATED_AT = null;
    protected $fillable = [
        'cNombre',
        'cDescripcion',
        'cProblematica',
        'cInicidencia',
        'idHuerto',
        'idResponsable',
        'idUsrAlta',
        'cEstatus',
        'dInicio',
        'dFin',
        'cExt'

    ];
}
