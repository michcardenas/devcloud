<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tags = Tag::withCount('noticias')
                   ->orderBy('nombre')
                   ->paginate(15);

        return view('admin.noticias.indextag', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required|max:255|unique:tags,nombre',
        ]);

        $tag = new Tag();
        $tag->nombre = $request->nombre;
        $tag->slug = Str::slug($request->nombre);
        $tag->save();

        return redirect()->route('admin.tags.index')
                         ->with('success', 'Tag creado correctamente.');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'nombre' => 'required|max:255|unique:tags,nombre,' . $tag->id,
        ]);

        $tag->nombre = $request->nombre;
        $tag->slug = Str::slug($request->nombre);
        $tag->save();

        return redirect()->route('admin.tags.index')
                         ->with('success', 'Tag actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tag $tag)
    {
        // Verificar si el tag tiene noticias asociadas
        if ($tag->noticias()->count() > 0) {
            return redirect()->route('admin.tags.index')
                             ->with('error', 'No se puede eliminar el tag porque tiene noticias asociadas.');
        }

        $tag->delete();

        return redirect()->route('admin.tags.index')
                         ->with('success', 'Tag eliminado correctamente.');
    }
}