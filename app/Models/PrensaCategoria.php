<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PrensaCategoria extends Model
{
    protected $table = 'prensa_categorias';

    protected $fillable = [
        'nombre',
        'descripcion',
    ];

    /**
     * Obtiene los elementos de prensa relacionados con esta categoría
     * Usando el campo 'categoria' que contiene el nombre en lugar de un ID
     */
    public function prensas()
    {
        return Prensa::where('categoria', $this->nombre);
    }

    /**
     * Obtiene los subtipos relacionados con esta categoría
     */
    public function subtipos(): HasMany
    {
        return $this->hasMany(PrensaSubtipo::class, 'categoria_id');
    }
}
