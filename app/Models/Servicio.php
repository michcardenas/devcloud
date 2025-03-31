<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servicio extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'etiqueta',
        'titulo',
        'descripcion',
        'imagen',
        'orden',
        'titulonoticia',
        'imagennoticia',
        'contenido',
    ];

    protected $casts = [
        'activo' => 'boolean',
    ];

    /**
     * Relación con las características
     */
    public function caracteristicas()
    {
        return $this->hasMany(Caracteristica::class);
    }
}