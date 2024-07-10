<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserInfo extends Model
{
    protected $table = 'usuarios';
    protected $primaryKey = 'idUsuario';
    const UPDATED_AT = null;
    #const CREATED_AT = null;
    protected $fillable = [
        'nombre',
        'apellido',
        'email',
        'telefono',
        'edad',
        'escolaridad',
        'semblanza',
        'comunidadIbero',
        'otraInstitucion',
        'discapacidad',
        'cExt',
        'tipo',
        'cEstatus',
        'iPublic',
        'idUsrAlta',
        'dNacimiento',
        'cLink',
        'cSemestre'
    ];
}
