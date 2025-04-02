<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testimonio extends Model
{
    use HasFactory;

    /**
     * La tabla asociada al modelo.
     *
     * @var string
     */
    protected $table = 'testimonios';

    /**
     * Los atributos que son asignables masivamente.
     *
     * @var array
     */
    protected $fillable = [
        'nombre',
        'contenido',
        'cargo',
        'numero_de_estrellas',
    ];

    /**
     * Los atributos que deben ser convertidos.
     *
     * @var array
     */
    protected $casts = [
        'numero_de_estrellas' => 'integer',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    /**
     * Validar que el número de estrellas esté entre 1 y 5.
     *
     * @param int $value
     * @return void
     */
    public function setNumeroDeEstrellasAttribute($value)
    {
        $this->attributes['numero_de_estrellas'] = max(1, min(5, $value));
    }
}