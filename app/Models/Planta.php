<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Planta extends Model
{
    use HasFactory;
    
    protected $table = 'plantas';
    protected $primaryKey = 'idPlanta';
    const UPDATED_AT = null;
    #const CREATED_AT = null;
    protected $fillable = [
        'cNombre',
        'cNombreLatin',
        'cEspecie',
        'cDescripcion',
        'cOrigen',
        'cAportacion',
        'cBeneficios',
        'cMantenimiento',
        'iComestible',
        'iEndemica',
        'iMedicinal',
        'iPerenne',
        'cEstatus',
        'idUsrAlta',
        'cExt'
    ];
}
