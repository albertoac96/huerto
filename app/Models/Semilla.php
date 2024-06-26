<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semilla extends Model
{
    use HasFactory;
    
    protected $table = 'semillas';
    protected $primaryKey = 'idSemilla';
    const UPDATED_AT = null;
    #const CREATED_AT = null;
    protected $fillable = [
        'cNombre',
        'cColor',
        'nPeso',
        'cCosecha',
        'cTipoPolinizacion',
        'nCostoUnitario',
        'nLote',
        'cProveedor',
        'cEstatus',
        'idUsrAlta'
    ];
}
