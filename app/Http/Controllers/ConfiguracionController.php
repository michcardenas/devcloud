<?php

namespace App\Http\Controllers;

use App\Models\NoticiasConfiguracion;
use Illuminate\Http\Request;

class ConfiguracionController extends Controller
{
    public function adminEdit()
    {
        $configuracion = NoticiasConfiguracion::obtenerConfiguracion();
        return view('admin.noticias.indexconfiguracion', compact('configuracion'));
    }

    public function adminUpdate(Request $request)
    {
        $request->validate([
            'titulo_seccion' => 'required|string|max:255',
            'etiqueta' => 'required|string|max:255',
            'descripcion' => 'required|string',
        ]);

        $configuracion = NoticiasConfiguracion::obtenerConfiguracion();
        $configuracion->update([
            'titulo_seccion' => $request->titulo_seccion,
            'etiqueta' => $request->etiqueta,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('admin.configuracion-noticias.edit')
                         ->with('success', 'Configuración actualizada correctamente.');
    }
}