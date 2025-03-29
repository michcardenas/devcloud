<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrensaRecurso extends Model
{
    use HasFactory;

    /**
     * La tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'prensa_recursos';

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'titulo',
        'descripcion',
        'formato',
        'tamano',
        'url',
        'orden'
    ];

    /**
     * Obtiene la URL completa del recurso
     */
    public function getArchivoUrlAttribute()
    {
        if ($this->url) {
            return asset('storage/' . $this->url);
        }
        
        return null;
    }
}