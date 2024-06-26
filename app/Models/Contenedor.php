<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contenedor extends Model
{
    use HasFactory;
    
    protected $table = 'contenedores';
    protected $primaryKey = 'idContenedor';
    const UPDATED_AT = null;
    #const CREATED_AT = null;
    protected $fillable = [
        'cNombre',
        'cTipo',
        'idUsrAlta',
        'cEstatus',
        'cExt',
        'idExperimento',
        'idEncargado'
    ];
}
