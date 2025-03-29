<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Faq extends Model
{
    use HasFactory;
    
    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'pregunta',
        'respuesta',
        'categoria',
        'orden',
        'activo'
    ];
    
    /**
     * Los atributos que deben ser convertidos a tipos nativos.
     *
     * @var array
     */
    protected $casts = [
        'activo' => 'boolean',
    ];
    
    /**
     * Valores predeterminados para los atributos del modelo.
     *
     * @var array
     */
    protected $attributes = [
        'activo' => true,
    ];
    
    /**
     * Scope para obtener solo las FAQs activas
     */
    public function scopeActivas($query)
    {
        return $query->where('activo', true);
    }
    
    /**
     * Obtiene las FAQs agrupadas por categoría
     */
    public static function getPorCategoria()
    {
        $faqs = self::activas()->orderBy('orden')->get();
        
        $result = collect();
        
        // Agrupar por categoría
        $grouped = $faqs->groupBy('categoria');
        
        foreach ($grouped as $categoria => $items) {
            $result->push([
                'categoria' => $categoria ?: 'General',
                'items' => $items
            ]);
        }
        
        return $result;
    }
}