<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Noticia;
use App\Models\NoticiasConfiguracion;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class NoticiasController extends Controller
{
    public function index(Request $request)
    {
        // Registrar información inicial de la petición
        \Log::info('Noticias index called', [
            'url' => $request->fullUrl(),
            'ip' => $request->ip(),
            'params' => $request->all(),
        ]);
    
        // Obtener la configuración de noticias
        $configuracion = NoticiasConfiguracion::obtenerConfiguracion();
        \Log::info('Configuración de noticias obtenida', ['configuracion' => $configuracion]);
    
        // Obtener categorías activas
        $categorias = Categoria::where('activa', true)->get();
        \Log::info('Categorías activas obtenidas', ['categorias_count' => $categorias->count()]);
    
        // Filtros
        $busqueda = $request->input('buscar');
        $categoriaSlug = $request->input('categoria');
        \Log::info('Filtros aplicados', ['buscar' => $busqueda, 'categoria' => $categoriaSlug]);
    
        // Consulta base
        $query = Noticia::with('categoria')
            ->publicadas()
            ->latest('fecha_publicacion');
    
        // Aplicar filtros si existen
        $query->buscar($busqueda)
              ->categoria($categoriaSlug);
    
        // Paginar resultados
        $noticias = $query->paginate(9);
        \Log::info('Noticias paginadas', [
            'noticias_count' => $noticias->count(),
            'total' => $noticias->total(),
            'current_page' => $noticias->currentPage(),
        ]);
    
        return view('noticias', compact(
            'configuracion',
            'categorias',
            'noticias'
        ));
    }
    

    public function adminIndex()
    {
        // Obtener todas las noticias ordenadas por fecha de creación
        $noticias = Noticia::with('categoria')
            ->latest()
            ->paginate(10);

        // Obtener categorías para los formularios
        $categorias = Categoria::where('activa', true)->get();

        return view('admin.noticias.index', compact('noticias', 'categorias'));
    }

    public function adminStore(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
            'categoria_id' => 'nullable|exists:categorias,id',
            'imagen' => 'nullable|image|max:2048', // 2MB máximo
            'fecha_publicacion' => 'required|date',
            'tiempo_lectura' => 'nullable|integer|min:1',
            'publicada' => 'boolean',
        ]);

        // Manejar subida de imagen
        $imagenPath = null;
        if ($request->hasFile('imagen')) {
            $imagenPath = $request->file('imagen')->store('noticias', 'public');
        }

        Noticia::create([
            'titulo' => $request->titulo,
            'slug' => \Str::slug($request->titulo),
            'contenido' => $request->contenido,
            'categoria_id' => $request->categoria_id,
            'imagen' => $imagenPath,
            'fecha_publicacion' => $request->fecha_publicacion,
            'tiempo_lectura' => $request->tiempo_lectura ?? 5,
            'publicada' => $request->has('publicada'),
        ]);

        return redirect()->route('admin.noticias.index')
            ->with('success', 'Noticia creada correctamente.');
    }

    public function adminEdit(Noticia $noticia)
    {
        if (request()->ajax()) {
            return response()->json($noticia);
        }

        // Si no es una petición AJAX, redirigir al listado
        return redirect()->route('admin.noticias.index');
    }

    public function adminUpdate(Request $request, Noticia $noticia)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
            'categoria_id' => 'nullable|exists:categorias,id',
            'imagen' => 'nullable|image|max:2048', // 2MB máximo
            'fecha_publicacion' => 'required|date',
            'tiempo_lectura' => 'nullable|integer|min:1',
            'publicada' => 'boolean',
        ]);

        // Manejar subida de imagen
        if ($request->hasFile('imagen')) {
            // Eliminar imagen anterior si existe
            if ($noticia->imagen) {
                \Storage::disk('public')->delete($noticia->imagen);
            }
            $imagenPath = $request->file('imagen')->store('noticias', 'public');
        } else {
            $imagenPath = $noticia->imagen;
        }

        $noticia->update([
            'titulo' => $request->titulo,
            'slug' => \Str::slug($request->titulo),
            'contenido' => $request->contenido,
            'categoria_id' => $request->categoria_id,
            'imagen' => $imagenPath,
            'fecha_publicacion' => $request->fecha_publicacion,
            'tiempo_lectura' => $request->tiempo_lectura ?? 5,
            'publicada' => $request->has('publicada'),
        ]);

        return redirect()->route('admin.noticias.index')
            ->with('success', 'Noticia actualizada correctamente.');
    }

    public function adminDestroy(Noticia $noticia)
    {
        // Eliminar imagen si existe
        if ($noticia->imagen) {
            \Storage::disk('public')->delete($noticia->imagen);
        }

        $noticia->delete();

        return redirect()->route('admin.noticias.index')
            ->with('success', 'Noticia eliminada correctamente.');
    }

    public function show($slug)
    {
        $noticia = Noticia::with('categoria')
            ->where('slug', $slug)
            ->publicadas()
            ->firstOrFail();

        // Noticias relacionadas (misma categoría)
        $relacionadas = Noticia::with('categoria')
            ->where('id', '!=', $noticia->id)
            ->where('categoria_id', $noticia->categoria_id)
            ->publicadas()
            ->latest('fecha_publicacion')
            ->take(3)
            ->get();

        return view('noticias.show', compact('noticia', 'relacionadas'));
    }
}
