<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoriaController extends Controller
{
    /**
     * Funciones administrativas
     */
    public function adminIndex()
    {
        $categorias = Categoria::withCount('noticias')->get();
        return view('admin.noticias.indexcategorias', compact('categorias'));
    }

    /**
     * Muestra las categorías en la vista específica de noticias
     */
    public function adminNoticiasCategoriasIndex()
    {
        $categorias = Categoria::withCount('noticias')->get();
        return view('admin.noticias.indexcategorias', compact('categorias'));
    }

    public function adminCreate()
    {
        return view('admin.categorias.create');
    }

    public function adminStore(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias',
            'icono' => 'nullable|string',
        ]);

        Categoria::create([
            'nombre' => $request->nombre,
            'slug' => Str::slug($request->nombre),
        ]);

        return redirect()->route('admin.categorias.index')
                         ->with('success', 'Categoría creada correctamente.');
    }

    public function adminEdit(Categoria $categoria)
    {
        return view('admin.categorias.edit', compact('categoria'));
    }

    public function adminUpdate(Request $request, Categoria $categoria)
    {
        $request->validate([
            'nombre' => 'required|string|max:255|unique:categorias,nombre,' . $categoria->id,
        ]);

        $categoria->update([
            'nombre' => $request->nombre,
            'slug' => Str::slug($request->nombre),
        ]);

        return redirect()->route('admin.categorias.index')
                         ->with('success', 'Categoría actualizada correctamente.');
    }

    public function adminDestroy(Categoria $categoria)
    {
        // Verificar si hay noticias asociadas
        if ($categoria->noticias()->count() > 0) {
            return redirect()->route('admin.categorias.index')
                             ->with('error', 'No se puede eliminar la categoría porque tiene noticias asociadas.');
        }

        $categoria->delete();

        return redirect()->route('admin.categorias.index')
                         ->with('success', 'Categoría eliminada correctamente.');
    }
}