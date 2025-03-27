<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    use HasFactory;

    protected $fillable = [
        'nombre',
        'slug',
        'icono',
        'activa'
    ];

    protected $casts = [
        'activa' => 'boolean',
    ];

    /**
     * Relación con noticias
     */
    public function noticias()
    {
        return $this->hasMany(Noticia::class);
    }
}