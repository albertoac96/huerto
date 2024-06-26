<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Noticia extends Model
{
    use HasFactory;
    
    protected $table = 'noticias';
    protected $primaryKey = 'idNoticia';
    const UPDATED_AT = null;
    #const CREATED_AT = null;
    protected $fillable = [
        'cNoticia',
        'cContenido',
        'idUsrAlta',
        'cEstatus',
        'cExt',
        'cLink'
    ];
}
