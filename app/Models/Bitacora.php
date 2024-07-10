<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bitacora extends Model
{
    use HasFactory;
    protected $table = 'bitacora_plantas';
    protected $primaryKey = 'idBitacora';
    protected $fillable = [
        'idrelPlantaContenedor',
        'idUsrAlta',
        'cEstatus',
        'cNota',
        'cEstatus',
        'cTitulo'
    ];
}
