<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Huerto extends Model
{
    use HasFactory;
    
    protected $table = 'huertos';
    protected $primaryKey = 'idHuerto';
    const UPDATED_AT = null;
    #const CREATED_AT = null;
    protected $fillable = [
        'cHuerto',
        'cDescripcion',
        'dCreacion',
        'cLat',
        'cLong',
        'cAltura',
        'cEstatus',
        'idUsrAlta',
    ];
}
