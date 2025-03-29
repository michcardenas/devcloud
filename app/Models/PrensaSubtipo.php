<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PrensaSubtipo extends Model
{
    protected $table = 'prensa_subtipos';
    
    protected $fillable = [
        'nombre',
        'categoria_id',
    ];

    public function categoria(): BelongsTo
    {
        return $this->belongsTo(PrensaCategoria::class, 'categoria_id');
    }

    /**
     * Obtiene los elementos de prensa relacionados con este subtipo
     * Usando el campo 'subtipo' que contiene el nombre
     */
    public function prensas()
    {
        return Prensa::where('subtipo', $this->nombre);
    }
}
