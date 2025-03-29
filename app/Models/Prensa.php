<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;
use App\Models\PrensaCategoria;
use App\Models\PrensaSubtipo;

class Prensa extends Model
{
    use HasFactory;

    /**
     * La tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'prensa';

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'titulo',
        'slug',
        'categoria',
        'subtipo',
        'fecha',
        'descripcion',
        'url',
        'imagen',
        'pdf_url',
        'destacado',
    ];

    /**
     * Los atributos que deben convertirse a tipos nativos.
     *
     * @var array
     */
    protected $casts = [
        'fecha' => 'datetime',
        'destacado' => 'boolean',
    ];

   /**
     * Obtiene la categoría a la que pertenece este elemento de prensa
     * Usando el campo 'categoria' que contiene el nombre
     */
    public function categoriaRelacion()
    {
        return PrensaCategoria::where('nombre', $this->categoria)->first();
    }

    /**
     * Obtiene el subtipo al que pertenece este elemento de prensa
     * Usando el campo 'subtipo' que contiene el nombre
     */
    public function subtipoRelacion()
    {
        return PrensaSubtipo::where('nombre', $this->subtipo)->first();
    }

    /**
     * Obtiene la URL de la imagen con la ruta completa
     */
    public function getImagenUrlAttribute()
    {
        if ($this->imagen) {
            return asset('storage/' . $this->imagen);
        }
        
        return asset('img/no-image.jpg');
    }

    /**
     * Obtiene la URL del PDF con la ruta completa
     */
    public function getPdfCompleteUrlAttribute()
    {
        if ($this->pdf_url) {
            return asset('storage/' . $this->pdf_url);
        }
        
        return null;
    }

    /**
     * Obtiene la fecha formateada para mostrar
     */
    public function getFechaFormateadaAttribute()
    {
        return $this->fecha->locale('es')->isoFormat('LL');
    }

    /**
     * Obtiene el mes y año de la fecha
     */
    public function getMesAnioAttribute()
    {
        return $this->fecha->locale('es')->isoFormat('MMMM YYYY');
    }
}