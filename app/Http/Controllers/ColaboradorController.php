<?php

namespace App\Http\Controllers;

use App\Models\Colaborador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;


class ColaboradorController extends Controller
{
    /**
     * Muestra todos los colaboradores y la vista principal.
     */
    public function index()
    {
        $colaboradores = Colaborador::all();
        return view('colaboradores.create', compact('colaboradores'));
    }

    /**
     * Guarda un nuevo colaborador.
     */


public function store(Request $request)
{
    $request->validate([
        'nombre' => 'required|string|max:255',
        'cargo' => 'required|string|max:255',
        'departamento' => 'nullable|string|max:255',
        'linkedin' => 'nullable|string|max:255',
        'descripcion' => 'nullable|string',
        'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);

    $data = $request->only(['nombre', 'cargo', 'departamento', 'linkedin', 'descripcion']);

    // Procesar imagen personalizada
    if ($request->hasFile('imagen')) {
        $imagen = $request->file('imagen');
        $nombreImagen = 'colaboradores/' . time() . '-' . Str::slug($request->nombre) . '.' . $imagen->getClientOriginalExtension();
        $imagen->move(public_path('images/colaboradores'), $nombreImagen);
        $data['imagen'] = 'images/' . $nombreImagen; // Ruta relativa que usarás con asset()
    }

    Colaborador::create($data);

    return redirect()->route('admin.colaboradores.index')
        ->with('success', 'Colaborador creado exitosamente.');
}

    

    /**
     * Actualiza un colaborador existente.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'cargo' => 'required|string|max:255',
            'departamento' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'descripcion' => 'nullable|string',
            'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);
    
        $colaborador = Colaborador::findOrFail($id);
    
        $data = $request->only(['nombre', 'cargo', 'departamento', 'linkedin', 'descripcion']);
    
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = 'colaboradores/' . time() . '-' . Str::slug($request->nombre) . '.' . $imagen->getClientOriginalExtension();
            $imagen->move(public_path('images/colaboradores'), $nombreImagen);
            $data['imagen'] = 'images/' . $nombreImagen;
        }
    
        $colaborador->update($data);
    
        return redirect()->route('admin.colaboradores.index')
            ->with('success', 'Colaborador actualizado correctamente.');
    }
    

    /**
     * Elimina un colaborador.
     */
    public function destroy($id)
    {
        $colaborador = Colaborador::findOrFail($id);
        $colaborador->delete();

        return redirect()->route('admin.colaboradores.index')
            ->with('success', 'Colaborador eliminado correctamente.');
    }
}
