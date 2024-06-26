<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class relUserProyecto extends Model
{
    use HasFactory;
    
    protected $table = 'relUserProyecto';
    protected $primaryKey = 'idUsuariosProyectos';
    const UPDATED_AT = null;
    #const CREATED_AT = null;
    protected $fillable = [
        'idProyecto',
        'idUsuario',
        'idExperimento'
    ];
}
