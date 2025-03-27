<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NoticiasConfiguracion extends Model
{
    use HasFactory;

    protected $table = 'noticias_configuracion';
    
    protected $fillable = [
        'titulo_seccion',
        'etiqueta',
        'descripcion'
    ];

    /**
     * Obtener la configuración actual o crear una por defecto
     */
    public static function obtenerConfiguracion()
    {
        $config = self::first();
        
        if (!$config) {
            $config = self::create([
                'titulo_seccion' => 'Últimas noticias y artículos',
                'etiqueta' => 'Blog y Noticias',
                'descripcion' => 'Mantente al día con las últimas tendencias y novedades sobre Cloud Computing, DevOps y Telecomunicaciones.'
            ]);
        }
        
        return $config;
    }
}