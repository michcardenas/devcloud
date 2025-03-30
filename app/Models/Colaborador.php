<?php


namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Colaborador extends Model
{
    // Tabla asociada
    protected $table = 'colaboradores';

    // Campos que se pueden asignar de forma masiva
    protected $fillable = [
        'nombre',
        'cargo',
        'departamento',
        'linkedin',
        'descripcion',
        'imagen',
    ];
}
