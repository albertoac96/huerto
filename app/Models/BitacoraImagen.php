<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BitacoraImagen extends Model
{
    use HasFactory;
    protected $table = 'bitacora_imagenes';
    protected $primaryKey = 'idBitImg';
    const UPDATED_AT = null;
    #const CREATED_AT = null;
    protected $fillable = [
        'cNombre',
        'idBitacora'
    ];
}
