<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class relPlantaContenedor extends Model
{
    use HasFactory;
    
    protected $table = 'relPlantaContenedor';
    protected $primaryKey = 'idRel';
    const UPDATED_AT = null;
    #const CREATED_AT = null;
    protected $fillable = [
        'idPlanta',
        'idContenedor',
        'idUsrAlta',
        'cEstatus'
    ];
}
