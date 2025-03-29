<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrensaConfiguracion extends Model
{
    use HasFactory;

    /**
     * La tabla asociada con el modelo.
     *
     * @var string
     */
    protected $table = 'prensa_configuracion';

    /**
     * Los atributos que son asignables en masa.
     *
     * @var array
     */
    protected $fillable = [
        'banner_etiqueta',
        'banner_titulo',
        'banner_subtitulo',
        'seccion_etiqueta',
        'seccion_titulo',
        'seccion_subtitulo',
        'notas_prensa_titulo',
        'apariciones_titulo',
        'recursos_titulo',
        'contacto_titulo',
        'contacto_descripcion',
        'contacto_email',
        'contacto_telefono',
        'suscripcion_titulo',
        'suscripcion_descripcion',
        'suscripcion_placeholder',
        'suscripcion_consentimiento',
        'suscripcion_boton',
        'meta_title',
        'meta_description',
        'meta_keywords'
    ];
}