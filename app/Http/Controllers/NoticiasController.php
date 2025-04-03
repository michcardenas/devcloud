<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Noticia;
use App\Models\Tag;
use App\Models\NoticiasConfiguracion;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\SeoMetadata;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;


class NoticiasController extends Controller
{
    public function index(Request $request)
    {
        \Log::info('Noticias index called', [
            'url' => $request->fullUrl(),
            'ip' => $request->ip(),
            'params' => $request->all(),
        ]);

        $configuracion = NoticiasConfiguracion::obtenerConfiguracion();
        \Log::info('Configuración de noticias obtenida', ['configuracion' => $configuracion]);

        $categorias = Categoria::where('activa', true)->get();
        \Log::info('Categorías activas obtenidas', ['categorias_count' => $categorias->count()]);

        $busqueda = $request->input('buscar');
        $categoriaSlug = $request->input('categoria');
        $tagSlug = $request->input('tag');
        \Log::info('Filtros aplicados', [
            'buscar' => $busqueda,
            'categoria' => $categoriaSlug,
            'tag' => $tagSlug
        ]);

        $query = Noticia::with(['categoria', 'tags'])
            ->publicadas()
            ->latest('fecha_publicacion');

        $query->buscar($busqueda)
            ->categoria($categoriaSlug);

        if ($tagSlug) {
            $query->whereHas('tags', function ($q) use ($tagSlug) {
                $q->where('slug', $tagSlug);
            });
            \Log::info('Filtro por tag aplicado', ['tag' => $tagSlug]);
        }

        $noticias = $query->paginate(6);
        \Log::info('Noticias paginadas', [
            'noticias_count' => $noticias->count(),
            'total' => $noticias->total(),
            'current_page' => $noticias->currentPage(),
        ]);

        // Obtener los metadatos SEO para la página de Noticias
        $seo = SeoMetadata::where('page_slug', 'noticias')->first();

        return view('noticias', compact('configuracion', 'categorias', 'noticias', 'seo'));
    }



    public function adminIndex()
    {
        // Obtener todas las noticias ordenadas por fecha de creación
        $noticias = Noticia::with(['categoria', 'tags'])
            ->latest()
            ->paginate(10);

        // Obtener categorías para los formularios
        $categorias = Categoria::where('activa', true)->get();

        // Obtener todos los tags disponibles
        $tags = Tag::orderBy('nombre')->get();

        return view('admin.noticias.index', compact('noticias', 'categorias', 'tags'));
    }

    public function adminStore(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'contenido' => 'required|string',
            'contenido_tarjeta' => 'nullable|string|max:200',
            'categoria_id' => 'nullable|exists:categorias,id',
            'imagen' => 'nullable|image|max:2048', // 2MB máximo
            'fecha_publicacion' => 'required|date',
            'tiempo_lectura' => 'nullable|integer|min:1',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

// Manejar subida de imagen para noticias
if ($request->hasFile('imagen')) {
    $imagen = $request->file('imagen');
    $nombreImagen = 'noticia-' . time() . '.' . $imagen->getClientOriginalExtension();
    
    // Crear directorio si no existe
    $directorioDestino = storage_path('app/public/images');
    if (!is_dir($directorioDestino)) {
        mkdir($directorioDestino, 0755, true);
    }
    
    // Mover el archivo
    $imagen->move($directorioDestino, $nombreImagen);
    
    // Guardar la ruta para la base de datos (como aparecerá en la URL)
    $imagenPath = '/images/' . $nombreImagen;
    
    \Log::info('Imagen guardada en: ' . $directorioDestino . '/' . $nombreImagen);
    \Log::info('Ruta pública: ' . $imagenPath);
}

        $noticia = Noticia::create([
            'titulo' => $request->titulo,
            'slug' => \Str::slug($request->titulo),
            'contenido' => $request->contenido,
            'contenido_tarjeta' => $request->contenido_tarjeta,
            'categoria_id' => $request->categoria_id,
            'imagen' => $imagenPath,
            'fecha_publicacion' => $request->fecha_publicacion,
            'tiempo_lectura' => $request->tiempo_lectura ?? 5,
        ]);

        // Sincronizar tags
        if ($request->has('tags')) {
            $noticia->tags()->sync($request->tags);
        }

        return redirect()->route('admin.noticias.index')
            ->with('success', 'Noticia creada correctamente.');
    }

    public function adminEdit(Noticia $noticia)
    {
        if (request()->ajax()) {
            // Agregar los IDs de los tags a la respuesta JSON
            $noticia->load('tags');
            $noticia->tag_ids = $noticia->tags->pluck('id')->toArray();
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
            'contenido_tarjeta' => 'nullable|string|max:200',
            'categoria_id' => 'nullable|exists:categorias,id',
            'imagen' => 'nullable|image|max:2048', // 2MB máximo
            'fecha_publicacion' => 'required|date',
            'tiempo_lectura' => 'nullable|integer|min:1',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

// Manejar subida de imagen
if ($request->hasFile('imagen')) {
    // Eliminar imagen anterior si existe
    if ($noticia->imagen) {
        // Si la ruta guardada incluye "storage/" al inicio, lo removemos para el Storage::delete
        $rutaImagen = str_replace('storage/', '', $noticia->imagen);
        \Storage::disk('public')->delete($rutaImagen);
    }
    
    $imagen = $request->file('imagen');
    $nombreImagen = 'noticia-' . time() . '.' . $imagen->getClientOriginalExtension();
    
    // Crear directorio si no existe
    $directorioDestino = storage_path('app/public/images');
    if (!is_dir($directorioDestino)) {
        mkdir($directorioDestino, 0755, true);
    }
    
    // Mover el archivo
    $imagen->move($directorioDestino, $nombreImagen);
    
    // Guardar la ruta para la base de datos (como aparecerá en la URL)
    $imagenPath = '/images/' . $nombreImagen;
} else {
    $imagenPath = $noticia->imagen;
}

        $noticia->update([
            'titulo' => $request->titulo,
            'slug' => \Str::slug($request->titulo),
            'contenido' => $request->contenido,
            'contenido_tarjeta' => $request->contenido_tarjeta,
            'categoria_id' => $request->categoria_id,
            'imagen' => $imagenPath,
            'fecha_publicacion' => $request->fecha_publicacion,
            'tiempo_lectura' => $request->tiempo_lectura ?? 5,
        ]);

        // Sincronizar tags
        $noticia->tags()->sync($request->tags ?? []);

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

        return view('shownoticias', compact('noticia', 'relacionadas'));
    }
}
