<?php

namespace App\Http\Controllers;
use App\Models\PaginaNosotros;
use App\Models\Colaborador;


use Illuminate\Http\Request;

class NosotrosController extends Controller
{

    
    public function index()
    {
        // Obtiene el primer registro de la tabla 'pagina_nosotros'
        $contenido = PaginaNosotros::first();
    
        // Obtiene todos los colaboradores (puedes ordenar si quieres)
        $colaboradores = Colaborador::orderBy('created_at', 'desc')->get();
    
        // Envía ambos a la vista
        return view('nosotros', compact('contenido', 'colaboradores'));
    }
    
}
