<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Tag extends Model
{
    use HasFactory;

    /**
     * La tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'tags';
    
    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'slug',
    ];

    /**
     * Obtiene las noticias asociadas a este tag.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function noticias(): BelongsToMany
    {
        return $this->belongsToMany(Noticia::class, 'noticia_tag', 'tag_id', 'noticia_id')
                    ->withTimestamps();
    }

    /**
     * Método para obtener el recuento de noticias para este tag.
     *
     * @return int
     */
    public function getNoticiasCountAttribute()
    {
        return $this->noticias()->count();
    }

    /**
     * El mutador para el atributo nombre.
     * 
     * @param string $value
     * @return void
     */
    public function setNombreAttribute($value)
    {
        $this->attributes['nombre'] = $value;
        $this->attributes['slug'] = \Illuminate\Support\Str::slug($value);
    }

    /**
     * Scope para filtrar por slug.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $slug
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeBySlug($query, $slug)
    {
        return $query->where('slug', $slug);
    }

    /**
     * Scope para buscar tags por nombre.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $search
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeSearch($query, $search)
    {
        return $query->where('nombre', 'LIKE', "%{$search}%");
    }
}