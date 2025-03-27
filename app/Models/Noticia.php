<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Noticia extends Model
{
    use HasFactory;

    protected $fillable = [
        'categoria_id',
        'titulo',
        'slug',
        'contenido',
        'imagen',
        'fecha_publicacion',
        'tiempo_lectura',
        'publicada'
    ];

    protected $casts = [
        'fecha_publicacion' => 'date',
        'publicada' => 'boolean',
    ];

    /**
     * Relación con categoría
     */
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    /**
     * Auto-generación de slug al guardar
     */
    protected static function boot()
    {
        parent::boot();
        
        static::creating(function ($noticia) {
            if (empty($noticia->slug)) {
                $noticia->slug = Str::slug($noticia->titulo);
            }
        });
    }

    /**
     * Scope para noticias publicadas
     */
    public function scopePublicadas($query)
    {
        return $query->where('publicada', true);
    }

    /**
     * Scope para filtrar por categoría
     */
    public function scopeCategoria($query, $categoria)
    {
        if ($categoria) {
            return $query->whereHas('categoria', function($q) use ($categoria) {
                $q->where('slug', $categoria);
            });
        }
        return $query;
    }

    /**
     * Scope para buscar
     */
    public function scopeBuscar($query, $termino)
    {
        if ($termino) {
            return $query->where(function($q) use ($termino) {
                $q->where('titulo', 'LIKE', "%{$termino}%")
                  ->orWhere('contenido', 'LIKE', "%{$termino}%");
            });
        }
        return $query;
    }
}