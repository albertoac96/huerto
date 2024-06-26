<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Biografia extends Model
{
    use HasFactory;

    protected $table = 'biografias';
    protected $primaryKey = 'idBiografia';
    const UPDATED_AT = null;
    #const CREATED_AT = null;
    protected $fillable = [
        'cBiografia',
        'cTitulo',
        'cContenido',
        'iPublica',
        'idUsrAlta',
        'cEstatus',
        'cExt'
    ];
}
