<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ContenedorTipo extends Model
{
    use HasFactory;
    protected $table = 'contenedores_tipos';
    protected $primaryKey = 'idTipo';
    const UPDATED_AT = null;
    #const CREATED_AT = null;
    protected $fillable = [
        'cNombre',
        'idUsrAlta'
    ];

    // Suponiendo que la tabla de contenedores se llama 'contenedores'
    public function contenedoresTotal() {
        return $this->hasMany(Contenedor::class, 'idTipo');
    }
}
