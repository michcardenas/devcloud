<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PartnerTecnologico extends Model
{
    protected $table = 'partner_tecnologicos';

    protected $fillable = [
        'tagline',
        'h2',
        'contenido',
        'posicion',

        'logo1', 'titulo_tarjeta1', 'tag1', 'posicion1',
        'logo2', 'titulo_tarjeta2', 'tag2', 'posicion2',
        'logo3', 'titulo_tarjeta3', 'tag3', 'posicion3',
        'logo4', 'titulo_tarjeta4', 'tag4', 'posicion4',
        'logo5', 'titulo_tarjeta5', 'tag5', 'posicion5',
        'logo6', 'titulo_tarjeta6', 'tag6', 'posicion6',
        'logo7', 'titulo_tarjeta7', 'tag7', 'posicion7',
        'logo8', 'titulo_tarjeta8', 'tag8', 'posicion8',

        'tagline2',
        'h2_2',
        'contenido2',

        'titulo_tarjeta_eco1',
        'subtitulo_eco1',
        'lista_tarjeta_eco1',

        'titulo_tarjeta_eco2',
        'subtitulo_eco2',
        'lista_tarjeta_eco2',

        'titulo_tarjeta_eco3',
        'subtitulo_eco3',
        'lista_tarjeta_eco3',
    ];
}
