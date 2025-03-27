<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PaginaNosotros extends Model
{
    protected $table = 'pagina_nosotros';

    protected $fillable = [
        'tagline1', 'titulo_h1', 'contenido1', 'imagen1',

        'imagen_tarjeta1', 'titulo_tarjeta1', 'contenido_tarjeta1',
        'imagen_tarjeta2', 'titulo_tarjeta2', 'contenido_tarjeta2',
        'imagen_tarjeta3', 'titulo_tarjeta3', 'contenido_tarjeta3',
        'imagen_tarjeta4', 'titulo_tarjeta4', 'contenido_tarjeta4',

        'tagline2', 'titulo_h2', 'contenido2', 'imagen2', 'contenido_imagen2',
        'mision', 'imagen_mision', 'vision', 'imagen_vision', 'valores', 'imagen_valores',

        'tagline3', 'titulo_h2_principios', 'contenido_principios',

        'imagen_tarjeta5', 'titulo_tarjeta5', 'contenido_tarjeta5',
        'imagen_tarjeta6', 'titulo_tarjeta6', 'contenido_tarjeta6',
        'imagen_tarjeta7', 'titulo_tarjeta7', 'contenido_tarjeta7',
        'imagen_tarjeta8', 'titulo_tarjeta8', 'contenido_tarjeta8',
        'imagen_tarjeta9', 'titulo_tarjeta9', 'contenido_tarjeta9',
        'imagen_tarjeta10', 'titulo_tarjeta10', 'contenido_tarjeta10',

        'tagline4', 'titulo_h2_equipo', 'contenido_equipo'
    ];
}
