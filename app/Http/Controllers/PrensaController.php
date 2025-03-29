<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Prensa;
use App\Models\PrensaCategoria;
use App\Models\PrensaSubtipo;
use App\Models\PrensaRecurso;
use App\Models\PrensaConfiguracion;
use App\Models\PrensaSuscriptor;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Carbon\Carbon;
use Illuminate\Support\Str;

class PrensaController extends Controller
{
    /********************************
     * MÉTODOS PARA FRONTEND
     ********************************/

    /**
     * Muestra la vista pública de Sala de Prensa
     */
    /**
     * Muestra la vista pública de Sala de Prensa (sin filtro destacado)
     */
    public function salaPrensaPublica()
{
    // Obtener todas las categorías
    $categorias = PrensaCategoria::orderBy('nombre')->get();

    // Obtener todos los elementos de prensa agrupados por categoría
    $prensasPorCategoria = [];
    
    // Obtener subtipos por categoría
    $subtiposPorCategoria = [];

    foreach ($categorias as $categoria) {
        // Obtener subtipos para esta categoría
        $subtipos = PrensaSubtipo::where('categoria_id', $categoria->id)
            ->orderBy('nombre')
            ->get();
        
        $subtiposPorCategoria[$categoria->nombre] = $subtipos;

        // Obtener elementos de prensa para esta categoría
        $prensas = Prensa::where('categoria', $categoria->nombre)
            ->orderBy('fecha', 'desc')
            ->limit(3) // Limitar a 3 elementos por categoría
            ->get();

        // Formatear fechas y añadir a la colección
        foreach ($prensas as $prensa) {
            $prensa->fecha_formateada = Carbon::parse($prensa->fecha)->format('d/m/Y');
        }

        // Guardar en el array asociativo
        $prensasPorCategoria[$categoria->nombre] = $prensas;
    }

    // Obtener recursos de marca
    $recursos = PrensaRecurso::orderBy('id', 'desc')->limit(3)->get();

    // Obtener textos de configuración para las diferentes secciones
    $configuracion = PrensaConfiguracion::first() ?? new PrensaConfiguracion();

    $bannerTextos = [
        'etiqueta' => $configuracion->banner_etiqueta ?? 'Sala de Prensa',
        'titulo' => $configuracion->banner_titulo ?? 'Recursos para medios',
        'subtitulo' => $configuracion->banner_subtitulo ?? 'Toda la información relevante sobre DevCloud Partners para profesionales de los medios de comunicación.',
    ];

    $seccionTextos = [
        'etiqueta' => $configuracion->seccion_etiqueta ?? 'Sala de prensa',
        'titulo' => $configuracion->seccion_titulo ?? 'Recursos para medios',
        'subtitulo' => $configuracion->seccion_subtitulo ?? 'Todo lo que necesitas saber sobre DevCloud Partners para medios de comunicación y material de prensa.',
    ];

    $contactoTextos = [
        'titulo' => $configuracion->contacto_titulo ?? 'Contacto para medios',
        'descripcion' => $configuracion->contacto_descripcion ?? 'Si eres periodista o medio de comunicación y necesitas más información, no dudes en contactar con nuestro departamento de comunicación.',
        'email' => $configuracion->contacto_email ?? 'prensa@devcloud.es',
        'telefono' => $configuracion->contacto_telefono ?? '+34 91 123 45 67',
        'telefono_num' => $configuracion->contacto_telefono_num ?? '+34912345867',
    ];

    $suscripcionTextos = [
        'titulo' => $configuracion->suscripcion_titulo ?? 'Suscríbete a nuestras notas de prensa',
        'descripcion' => $configuracion->suscripcion_descripcion ?? 'Recibe nuestras notas de prensa y comunicados directamente en tu email.',
        'placeholder' => $configuracion->suscripcion_placeholder ?? 'Tu email profesional',
        'consentimiento' => $configuracion->suscripcion_consentimiento ?? 'Acepto recibir comunicaciones y la ',
        'boton' => $configuracion->suscripcion_boton ?? 'Suscribirse',
    ];

    // Títulos personalizados para las categorías (si existen en la configuración)
    $recursosTitulo = $configuracion->recursos_titulo ?? 'Recursos de marca';

    return view('prensa', compact(
        'categorias',
        'prensasPorCategoria',
        'subtiposPorCategoria',
        'recursos',
        'bannerTextos',
        'seccionTextos',
        'contactoTextos',
        'suscripcionTextos',
        'recursosTitulo'
    ));
}

    /**
     * Muestra todas las notas de prensa
     */
    public function notasPrensa(Request $request)
    {
        $query = Prensa::where('categoria', 'Notas de prensa')
            ->orderBy('fecha', 'desc');

        // Filtrar por subtipo si se proporciona
        if ($request->has('subtipo') && $request->subtipo != 'todos') {
            $query->where('subtipo', $request->subtipo);
        }

        // Filtrar por año si se proporciona
        if ($request->has('anio') && $request->anio != 'todos') {
            $query->whereYear('fecha', $request->anio);
        }

        $notas = $query->paginate(10);

        // Obtener subtipos para el filtro
        $subtipos = PrensaSubtipo::where('categoria_id', function ($query) {
            $query->select('id')
                ->from('prensa_categorias')
                ->where('nombre', 'Notas de prensa')
                ->first();
        })->pluck('nombre');

        // Obtener años disponibles para el filtro
        $años = Prensa::where('categoria', 'Notas de prensa')
            ->selectRaw('YEAR(fecha) as año')
            ->distinct()
            ->orderBy('año', 'desc')
            ->pluck('año');

        return view('prensa.notas', [
            'notas' => $notas,
            'subtipos' => $subtipos,
            'años' => $años,
            'filtroSubtipo' => $request->subtipo ?? 'todos',
            'filtroAnio' => $request->anio ?? 'todos',
        ]);
    }

    /**
     * Muestra detalle de una nota de prensa
     */
    public function notaPrensaDetalle($id)
    {
        $nota = Prensa::findOrFail($id);

        // Obtener notas relacionadas (mismo subtipo)
        $notasRelacionadas = Prensa::where('id', '!=', $id)
            ->where('subtipo', $nota->subtipo)
            ->orderBy('fecha', 'desc')
            ->take(3)
            ->get();

        return view('prensa.detalle', [
            'nota' => $nota,
            'notasRelacionadas' => $notasRelacionadas
        ]);
    }


    /**
     * Descarga un archivo PDF
     */
    public function descargarPdf($filename)
    {
        // Construye la ruta completa al archivo
        $path = storage_path('app/public/prensa/pdf/' . $filename);

        // Verifica si el archivo existe
        if (!file_exists($path)) {
            abort(404, 'El archivo no existe');
        }

        // Devuelve el archivo como respuesta para descarga
        return response()->file($path);
    }

    /**
     * Muestra todos los recursos disponibles
     */
    public function recursosPublicos()
    {
        $recursos = PrensaRecurso::orderBy('orden')->get();

        return view('prensa.recursos', [
            'recursos' => $recursos
        ]);
    }

    /**
     * Procesa la suscripción a notas de prensa
     */
    public function suscribir(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:prensa_suscriptores,email',
            'acepta_politica' => 'required'
        ], [
            'email.unique' => 'Este email ya está suscrito a nuestras notas de prensa.'
        ]);

        PrensaSuscriptor::create([
            'email' => $request->email,
            'fecha_suscripcion' => Carbon::now(),
            'activo' => true
        ]);

        return redirect()->back()->with('success', 'Te has suscrito correctamente a nuestras notas de prensa.');
    }

/********************************
 * MÉTODOS PARA PANEL ADMIN
 ********************************/

/**
 * Muestra el listado de elementos de prensa en el admin
 */
public function index()
{
    $prensaItems = Prensa::orderBy('fecha', 'desc')
        ->paginate(10);

    // Obtener categorías y subtipos para el formulario
    $categorias = PrensaCategoria::orderBy('nombre')->get();
    $subtipos = PrensaSubtipo::orderBy('nombre')->get();

    return view('admin.prensa.index', compact('prensaItems', 'categorias', 'subtipos'));
}

/**
 * Obtiene los subtipos asociados a una categoría
 */
public function getSubtipos($categoriaId)
{
    // Obtener los subtipos para la categoría seleccionada
    $subtipos = PrensaSubtipo::where('categoria_id', $categoriaId)
        ->orderBy('nombre')
        ->get();

    return response()->json($subtipos);
}

/**
 * Almacena un nuevo elemento de prensa
 */
public function store(Request $request)
{
    $validated = $request->validate([
        'titulo' => 'required|string|max:255',
        'categoria' => 'required|string',
        'subtipo' => 'nullable|string|max:100',
        'fecha' => 'required|date',
        'descripcion' => 'required|string',
        'url' => 'nullable|url|max:255',
        'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'pdf_url' => 'nullable|file|mimes:pdf,zip,rar|max:10240',
        'destacado' => 'nullable|boolean',
    ]);

    // Handle image upload
    if ($request->hasFile('imagen')) {
        $imagePath = $request->file('imagen')->store('prensa', 'public');
        $validated['imagen'] = $imagePath;
    }

    // Handle file upload (PDF, ZIP, RAR)
    if ($request->hasFile('pdf_url')) {
        // Obtener la extensión original
        $extension = $request->file('pdf_url')->getClientOriginalExtension();
        
        // Construir un nombre de archivo único conservando la extensión
        $fileName = 'prensa/archivos/' . uniqid() . '_' . time() . '.' . $extension;
        
        // Guardar el archivo
        $request->file('pdf_url')->storeAs('public', $fileName);
        
        $validated['pdf_url'] = $fileName;
    }

    // Set destacado to false if not provided
    $validated['destacado'] = $request->has('destacado') ? true : false;

    // Generar slug a partir del título
    $validated['slug'] = Str::slug($validated['titulo']);

    Prensa::create($validated);

    return redirect()->route('admin.prensa.index')
        ->with('success', 'Contenido creado correctamente.');
}

/**
 * Muestra el formulario para editar un elemento
 */
public function edit($id)
{
    $prensaItem = Prensa::findOrFail($id);

    // Format for JS consumption
    return response()->json([
        'id' => $prensaItem->id,
        'titulo' => $prensaItem->titulo,
        'categoria' => $prensaItem->categoria,
        'subtipo' => $prensaItem->subtipo,
        'fecha' => $prensaItem->fecha->format('Y-m-d'),
        'descripcion' => $prensaItem->descripcion,
        'url' => $prensaItem->url,
        'imagen' => $prensaItem->imagen,
        'pdf_url' => $prensaItem->pdf_url,
        'destacado' => (bool)$prensaItem->destacado,
    ]);
}

public function getCategoriaByName(Request $request)
{
    $nombre = $request->query('nombre');
    $categoria = PrensaCategoria::where('nombre', $nombre)->first();
    
    if ($categoria) {
        return response()->json($categoria);
    }
    
    return response()->json(['error' => 'Categoría no encontrada'], 404);
}

/**
 * Actualiza un elemento de prensa
 */
public function update(Request $request, $id)
{
    $prensaItem = Prensa::findOrFail($id);

    $validated = $request->validate([
        'titulo' => 'required|string|max:255',
        'categoria' => 'required|string',
        'subtipo' => 'nullable|string|max:100',
        'fecha' => 'required|date',
        'descripcion' => 'required|string',
        'url' => 'nullable|url|max:255',
        'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        'pdf_url' => 'nullable|file|mimes:pdf,zip,rar|max:10240',
        'destacado' => 'nullable|boolean',
    ]);

    // Handle image upload
    if ($request->hasFile('imagen')) {
        // Delete old image if exists
        if ($prensaItem->imagen && Storage::disk('public')->exists($prensaItem->imagen)) {
            Storage::disk('public')->delete($prensaItem->imagen);
        }

        $imagePath = $request->file('imagen')->store('prensa', 'public');
        $validated['imagen'] = $imagePath;
    }

    // Handle file upload (PDF, ZIP, RAR)
    if ($request->hasFile('pdf_url')) {
        // Delete old file if exists
        if ($prensaItem->pdf_url && Storage::disk('public')->exists($prensaItem->pdf_url)) {
            Storage::disk('public')->delete($prensaItem->pdf_url);
        }

        // Obtener la extensión original
        $extension = $request->file('pdf_url')->getClientOriginalExtension();
        
        // Construir un nombre de archivo único conservando la extensión
        $fileName = 'prensa/archivos/' . uniqid() . '_' . time() . '.' . $extension;
        
        // Guardar el archivo
        $request->file('pdf_url')->storeAs('public', $fileName);
        
        $validated['pdf_url'] = $fileName;
    }

    // Set destacado to false if not provided
    $validated['destacado'] = $request->has('destacado') ? true : false;

    // Update slug if título has changed
    if ($prensaItem->titulo != $validated['titulo']) {
        $validated['slug'] = Str::slug($validated['titulo']);
    }

    $prensaItem->update($validated);

    return redirect()->route('admin.prensa.index')
        ->with('success', 'Contenido actualizado correctamente.');
}

/**
 * Elimina un elemento de prensa
 */
public function destroy($id)
{
    $prensaItem = Prensa::findOrFail($id);

    // Delete associated files
    if ($prensaItem->imagen && Storage::disk('public')->exists($prensaItem->imagen)) {
        Storage::disk('public')->delete($prensaItem->imagen);
    }

    if ($prensaItem->pdf_url && Storage::disk('public')->exists($prensaItem->pdf_url)) {
        Storage::disk('public')->delete($prensaItem->pdf_url);
    }

    $prensaItem->delete();

    return redirect()->route('admin.prensa.index')
        ->with('success', 'Contenido eliminado correctamente.');
}

/**
 * Descargar archivo adjunto
 */
public function descargarArchivo($filename)
{
    $path = storage_path('app/public/prensa/archivos/' . $filename);
    
    if (!file_exists($path)) {
        abort(404, 'El archivo no existe');
    }
    
    // Obtener información del archivo
    $extension = pathinfo($path, PATHINFO_EXTENSION);
    $mimeType = '';
    
    // Determinar el tipo MIME según la extensión
    switch (strtolower($extension)) {
        case 'pdf':
            $mimeType = 'application/pdf';
            break;
        case 'zip':
            $mimeType = 'application/zip';
            break;
        case 'rar':
            $mimeType = 'application/x-rar-compressed';
            break;
        default:
            $mimeType = 'application/octet-stream';
    }
    
    // Descargar el archivo con el nombre original
    return response()->download($path, $filename, [
        'Content-Type' => $mimeType,
    ]);
}
    /**
     * Muestra la página de configuración en el admin
     */
    public function configuracion()
    {
        // Get configuration values from database
        $configuracion = PrensaConfiguracion::first();

        // If no configuration exists, use default values
        if (!$configuracion) {
            $configuracion = new PrensaConfiguracion();
            $defaultTextos = $this->obtenerTextos();

            foreach ($defaultTextos as $key => $value) {
                if (property_exists($configuracion, $key)) {
                    $configuracion->$key = $value;
                }
            }
        }

        return view('admin.prensa.indexconfiguracion', compact('configuracion'));
    }

    public function saveConfiguracion(Request $request)
    {
        $validated = $request->validate([
            // Banner Principal
            'banner_etiqueta' => 'required|string|max:100',
            'banner_titulo' => 'required|string|max:100',
            'banner_subtitulo' => 'required|string',

            // Sección de Recursos
            'seccion_etiqueta' => 'required|string|max:100',
            'seccion_titulo' => 'required|string|max:100',
            'seccion_subtitulo' => 'required|string',

            // Sección de Contacto
            'contacto_titulo' => 'required|string|max:100',
            'contacto_descripcion' => 'required|string',
            'contacto_email' => 'required|email|max:100',
            'contacto_telefono' => 'required|string|max:100',

            // Sección de Suscripción
            'suscripcion_titulo' => 'required|string|max:100',
            'suscripcion_descripcion' => 'required|string',
            'suscripcion_placeholder' => 'required|string|max:100',
            'suscripcion_boton' => 'required|string|max:100',
            'suscripcion_consentimiento' => 'required|string',
        ]);

        // Formatear el teléfono para links
        $validated['contacto_telefono_num'] = preg_replace('/[^0-9+]/', '', $validated['contacto_telefono']);

        // Añadir valores por defecto para campos obligatorios que no están en el formulario
        $validated['notas_prensa_titulo'] = 'Notas de prensa';
        $validated['apariciones_titulo'] = 'Apariciones en medios';
        $validated['recursos_titulo'] = 'Recursos de marca';

        // Obtener la configuración existente o crear nueva
        $configuracion = PrensaConfiguracion::first();

        if ($configuracion) {
            $configuracion->update($validated);
        } else {
            PrensaConfiguracion::create($validated);
        }

        return redirect()->route('admin.prensa.configuracion')
            ->with('success', 'Configuración guardada correctamente.');
    }


    /**
     * Método para gestionar las categorías de prensa
     */
    public function categorias()
    {
        // Obtiene todas las categorías ordenadas por nombre
        // Sin usar withCount que está generando el error
        $categorias = PrensaCategoria::orderBy('nombre')->get();

        // Obtiene los subtipos con sus relaciones a categorías
        $subtipos = PrensaSubtipo::with('categoria')
            ->orderBy('nombre')
            ->get();

        return view('admin.prensa.indexcategorias', compact('categorias', 'subtipos'));
    }

    /**
     * Guarda una nueva categoría
     */
    public function storeCategoria(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255|unique:prensa_categorias,nombre',
            'descripcion' => 'nullable|string',
        ]);

        PrensaCategoria::create($validated);

        return redirect()->route('admin.prensa.categorias')
            ->with('success', 'Categoría creada correctamente.');
    }

    /**
     * Obtiene una categoría para editar
     */
    public function editCategoria($id)
    {
        $categoria = PrensaCategoria::findOrFail($id);
        return response()->json($categoria);
    }

    /**
     * Actualiza una categoría existente
     */
    public function updateCategoria(Request $request, $id)
    {
        $categoria = PrensaCategoria::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'required|string|max:255|unique:prensa_categorias,nombre,' . $id,
            'descripcion' => 'nullable|string',
        ]);

        $categoria->update($validated);

        return redirect()->route('admin.prensa.categorias')
            ->with('success', 'Categoría actualizada correctamente.');
    }

    /**
     * Elimina una categoría
     */
    public function destroyCategoria($id)
    {
        $categoria = PrensaCategoria::findOrFail($id);

        // Check if there are news items using this category
        // Usando el campo 'categoria' que probablemente contiene el nombre de la categoría
        $categoria = PrensaCategoria::findOrFail($id);
        $newsCount = Prensa::where('categoria', $categoria->nombre)->count();

        if ($newsCount > 0) {
            return redirect()->route('admin.prensa.categorias')
                ->with('error', 'No se puede eliminar la categoría porque está siendo utilizada por ' . $newsCount . ' elementos.');
        }

        // Check if there are subtypes for this category
        $subtypesCount = PrensaSubtipo::where('categoria_id', $id)->count();

        if ($subtypesCount > 0) {
            return redirect()->route('admin.prensa.categorias')
                ->with('error', 'No se puede eliminar la categoría porque tiene ' . $subtypesCount . ' subtipos asociados.');
        }

        $categoria->delete();

        return redirect()->route('admin.prensa.categorias')
            ->with('success', 'Categoría eliminada correctamente.');
    }

    /**
     * Guarda un nuevo subtipo de medio
     */
    public function storeSubtipo(Request $request)
    {
        $validated = $request->validate([
            'nombre_subtipo' => 'required|string|max:255|unique:prensa_subtipos,nombre',
            'categoria_id' => 'required|exists:prensa_categorias,id',
        ]);

        PrensaSubtipo::create([
            'nombre' => $validated['nombre_subtipo'],
            'categoria_id' => $validated['categoria_id'],
        ]);

        return redirect()->route('admin.prensa.categorias')
            ->with('success', 'Subtipo de medio creado correctamente.');
    }

    /**
     * Actualiza un subtipo de medio existente
     */
    public function updateSubtipo(Request $request, $id)
    {
        $subtipo = PrensaSubtipo::findOrFail($id);

        $validated = $request->validate([
            'nombre_subtipo' => 'required|string|max:255|unique:prensa_subtipos,nombre,' . $id,
            'categoria_id' => 'nullable|exists:prensa_categorias,id',
        ]);

        $subtipo->update([
            'nombre' => $validated['nombre_subtipo'],
            'categoria_id' => $validated['categoria_id'] ?? $subtipo->categoria_id,
        ]);

        return redirect()->route('admin.prensa.categorias')
            ->with('success', 'Subtipo de medio actualizado correctamente.');
    }

    /**
     * Elimina un subtipo de medio
     */
    public function destroySubtipo($id)
    {
        $subtipo = PrensaSubtipo::findOrFail($id);

        // Check if there are news items using this subtype
        $newsCount = Prensa::where('subtipo_id', $id)->count();

        if ($newsCount > 0) {
            return redirect()->route('admin.prensa.categorias')
                ->with('error', 'No se puede eliminar el subtipo porque está siendo utilizado por ' . $newsCount . ' elementos.');
        }

        $subtipo->delete();

        return redirect()->route('admin.prensa.categorias')
            ->with('success', 'Subtipo de medio eliminado correctamente.');
    }

    /**
     * Obtiene todos los textos para la vista
     * Primero intenta obtenerlos de la BD, si no existen usa valores por defecto
     */
    private function obtenerTextos()
    {
        $configuracion = PrensaConfiguracion::first();

        if ($configuracion) {
            // Convert to array and filter null values
            $textos = $configuracion->toArray();
            return array_filter($textos, function ($value) {
                return $value !== null;
            });
        }

        // Default values if no configuration exists
        return [
            // Banner principal
            'banner_etiqueta' => 'Sala de Prensa',
            'banner_titulo' => 'Recursos para medios',
            'banner_subtitulo' => 'Toda la información relevante sobre DevCloud Partners para profesionales de los medios de comunicación.',

            // Sección de recursos
            'seccion_etiqueta' => 'Sala de prensa',
            'seccion_titulo' => 'Recursos para medios',
            'seccion_subtitulo' => 'Todo lo que necesitas saber sobre DevCloud Partners para medios de comunicación y material de prensa.',

            // Títulos de las secciones
            'notas_prensa_titulo' => 'Notas de prensa',
            'apariciones_titulo' => 'Apariciones en medios',
            'recursos_titulo' => 'Recursos de marca',

            // Textos de contacto
            'contacto_titulo' => 'Contacto para medios',
            'contacto_descripcion' => 'Si eres periodista o medio de comunicación y necesitas más información, no dudes en contactar con nuestro departamento de comunicación.',
            'contacto_email' => 'prensa@devcloud.es',
            'contacto_telefono' => '+34 91 123 45 67',

            // Textos del formulario de suscripción
            'suscripcion_titulo' => 'Suscríbete a nuestras notas de prensa',
            'suscripcion_descripcion' => 'Recibe nuestras notas de prensa y comunicados directamente en tu email.',
            'suscripcion_placeholder' => 'Tu email profesional',
            'suscripcion_consentimiento' => 'Acepto recibir comunicaciones y la',
            'suscripcion_boton' => 'Suscribirse',

            // SEO
            'meta_title' => 'Sala de Prensa | DevCloud Partners',
            'meta_description' => 'Toda la información relevante sobre DevCloud Partners para profesionales de los medios de comunicación.',
            'meta_keywords' => 'sala de prensa, notas de prensa, recursos, medios, DevCloud',
        ];
    }

    /**
     * Helper function to format bytes to human readable size
     */
    private function formatBytes($bytes, $precision = 2)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        $bytes = max($bytes, 0);
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);

        $bytes /= pow(1024, $pow);

        return round($bytes, $precision) . ' ' . $units[$pow];
    }
}
