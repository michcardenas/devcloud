<?php

namespace App\Http\Controllers;

use App\Models\Servicio;
use App\Models\Caracteristica;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Models\ServiciosPage;
use Illuminate\Support\Facades\File;

class ServicioController extends Controller
{
    /**
     * Muestra la vista pública de servicios
     */
    public function index()
    {
        $servicios = Servicio::with('caracteristicas')
            ->where('activo', true)
            ->orderBy('orden')
            ->get();

        $serviciosPage = ServiciosPage::latest()->first();

        return view('servicios', compact('servicios', 'serviciosPage'));
    }

    /**
     * Muestra la vista administrativa de servicios
     */
    public function adminIndex()
    {
        $servicios = Servicio::with('caracteristicas')->orderBy('orden')->paginate(10);
        $ultimoOrden = Servicio::max('orden') ?? 0;
        $iconos = $this->getIconosList();

        // Obtenemos el primer (o el último) registro de ServiciosPage
        $serviciosPage = ServiciosPage::latest()->first(); // o ->first() si solo habrá uno

        return view('admin.homepage.editservicios', compact('servicios', 'ultimoOrden', 'iconos', 'serviciosPage'));
    }

    /**
     * Muestra el formulario para crear un nuevo servicio/noticia
     */
    public function create()
    {
        return view('admin.servicios.create');
    }

    /**
     * Muestra el formulario para editar un servicio (parte de la vista admin)
     */
    public function edit($id)
    {
        $servicios = Servicio::with('caracteristicas')->orderBy('orden')->get();
        $editarServicio = Servicio::findOrFail($id);
        $ultimoOrden = Servicio::max('orden') ?? 0;
        $iconos = $this->getIconosList();

        return view('admin.homepage.editservicios', compact('servicios', 'editarServicio', 'ultimoOrden', 'iconos'));
    }

    /**
     * Muestra el formulario para editar una característica (parte de la vista admin)
     */
    public function editCaracteristica($id)
    {
        $servicios = Servicio::with('caracteristicas')->orderBy('orden')->get();
        $editarCaracteristica = Caracteristica::findOrFail($id);
        $ultimoOrden = Servicio::max('orden') ?? 0;
        $iconos = $this->getIconosList();

        return view('admin.homepage.editservicios', compact('servicios', 'editarCaracteristica', 'ultimoOrden', 'iconos'));
    }

    /**
     * Muestra la lista de características de un servicio (parte de la vista admin)
     */
    public function caracteristicas($id)
    {
        $servicios = Servicio::with('caracteristicas')->orderBy('orden')->get();
        $servicioActual = Servicio::findOrFail($id);
        $caracteristicas = $servicioActual->caracteristicas()->orderBy('orden')->get();
        $ultimoOrden = Servicio::max('orden') ?? 0;
        $iconos = $this->getIconosList();

        return view('admin.homepage.editservicios', compact('servicios', 'servicioActual', 'caracteristicas', 'ultimoOrden', 'iconos'));
    }

    /**
     * Almacena un nuevo servicio
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'etiqueta' => 'required|string|max:255',
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'orden' => 'required|integer',
            'titulonoticia' => 'required|string|max:255',
            'contenido' => 'required|string',
            'imagennoticia' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Procesar imagen principal
        if ($request->hasFile('imagen')) {
            $imagen = $request->file('imagen');
            $nombreImagen = 'servicios/' . time() . '-' . Str::slug($request->nombre) . '.' . $imagen->getClientOriginalExtension();
            $imagen->move(public_path('images/servicios'), $nombreImagen);
            $validated['imagen'] = 'images/' . $nombreImagen;
        }

        // Procesar imagen de noticia
        // En el controlador, actualiza el método store/update:
        if ($request->hasFile('imagennoticia')) {
            // Eliminar imagen anterior si existe (en caso de update)
            if (isset($servicio) && $servicio->imagennoticia) {
                Storage::disk('public')->delete($servicio->imagennoticia);
            }

            // Guardar la nueva imagen
            $path = $request->file('imagennoticia')->store('servicios/noticias', 'public');
            $validated['imagennoticia'] = $path;
        }

        Servicio::create($validated);

        return redirect()->route('admin.servicios.index')
            ->with('success', 'Servicio creado correctamente');
    }

    /**
     * Actualiza un servicio existente
     */
    public function update(Request $request, $id)
    {
        $servicio = Servicio::findOrFail($id);

        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'etiqueta' => 'required|string|max:255',
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'orden' => 'required|integer',
            'titulonoticia' => 'required|string|max:255',
            'contenido' => 'required|string',
            'imagennoticia' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        // Procesar imagen principal
        if ($request->hasFile('imagen')) {
            // Eliminar imagen anterior si existe
            if ($servicio->imagen && file_exists(public_path($servicio->imagen))) {
                unlink(public_path($servicio->imagen));
            }

            $imagen = $request->file('imagen');
            $nombreImagen = 'servicios/' . time() . '-' . Str::slug($request->nombre) . '.' . $imagen->getClientOriginalExtension();
            $imagen->move(public_path('images/servicios'), $nombreImagen);
            $validated['imagen'] = 'images/' . $nombreImagen;
        }

        // Procesar imagen de noticia
        // En el controlador, actualiza el método store/update:
        if ($request->hasFile('imagennoticia')) {
            // Eliminar imagen anterior si existe (en caso de update)
            if (isset($servicio) && $servicio->imagennoticia) {
                Storage::disk('public')->delete($servicio->imagennoticia);
            }

            // Guardar la nueva imagen
            $path = $request->file('imagennoticia')->store('servicios/noticias', 'public');
            $validated['imagennoticia'] = $path;
        }


        $servicio->update($validated);

        return redirect()->route('admin.servicios.index')
            ->with('success', 'Servicio actualizado correctamente');
    }

    /**
     * Elimina un servicio
     */
    public function destroy($id)
    {
        $servicio = Servicio::findOrFail($id);

        // Eliminar imagen principal si existe
        if ($servicio->imagen && file_exists(public_path($servicio->imagen))) {
            unlink(public_path($servicio->imagen));
        }

        // Eliminar imagen de noticia si existe
        if ($servicio->imagennoticia && file_exists(public_path($servicio->imagennoticia))) {
            unlink(public_path($servicio->imagennoticia));
        }

        // Las características se eliminarán automáticamente por la relación onDelete('cascade')
        $servicio->delete();

        return redirect()->route('admin.servicios.index')
            ->with('success', 'Servicio eliminado correctamente');
    }

    /**
     * Almacena una nueva característica
     */
    public function storeCaracteristica(Request $request)
    {
        $validated = $request->validate([
            'servicio_id' => 'required|exists:servicios,id',
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'icono' => 'required|string',
            'orden' => 'required|integer'
        ]);

        Caracteristica::create($validated);

        return redirect()->route('admin.servicios.caracteristicas', $request->servicio_id)
            ->with('success', 'Característica creada correctamente');
    }

    /**
     * Actualiza una característica existente
     */
    public function updateCaracteristica(Request $request, $id)
    {
        $caracteristica = Caracteristica::findOrFail($id);

        $validated = $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'icono' => 'required|string',
            'orden' => 'required|integer'
        ]);

        $caracteristica->update($validated);

        return redirect()->route('admin.servicios.caracteristicas', $caracteristica->servicio_id)
            ->with('success', 'Característica actualizada correctamente');
    }

    /**
     * Elimina una característica
     */
    public function destroyCaracteristica($id)
    {
        $caracteristica = Caracteristica::findOrFail($id);
        $servicio_id = $caracteristica->servicio_id;

        $caracteristica->delete();

        return redirect()->route('admin.servicios.caracteristicas', $servicio_id)
            ->with('success', 'Característica eliminada correctamente');
    }

    /**
     * Reordena los servicios
     */
    public function reorder(Request $request)
    {
        $ids = $request->input('ids', []);

        foreach ($ids as $index => $id) {
            Servicio::where('id', $id)->update(['orden' => $index + 1]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Reordena las características de un servicio
     */
    public function reorderCaracteristicas(Request $request, $servicio_id)
    {
        $ids = $request->input('ids', []);

        foreach ($ids as $index => $id) {
            Caracteristica::where('id', $id)->update(['orden' => $index + 1]);
        }

        return response()->json(['success' => true]);
    }

    /**
     * Obtener lista de iconos disponibles
     */
    private function getIconosList()
    {
        return [
            'cloud' => '<path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15a4.5 4.5 0 004.5 4.5H18a3.75 3.75 0 001.332-7.257 3 3 0 00-3.758-3.848 5.25 5.25 0 00-10.233 2.33A4.502 4.502 0 002.25 15z" />',
            'globe' => '<path stroke-linecap="round" stroke-linejoin="round" d="M12 21a9.004 9.004 0 008.716-6.747M12 21a9.004 9.004 0 01-8.716-6.747M12 21c2.485 0 4.5-4.03 4.5-9S14.485 3 12 3m0 18c-2.485 0-4.5-4.03-4.5-9S9.515 3 12 3m0 0a8.997 8.997 0 017.843 4.582M12 3a8.997 8.997 0 00-7.843 4.582m15.686 0A11.953 11.953 0 0112 10.5c-2.998 0-5.74-1.1-7.843-2.918m15.686 0A8.959 8.959 0 0121 12c0 .778-.099 1.533-.284 2.253m0 0A17.919 17.919 0 0112 16.5c-3.162 0-6.133-.815-8.716-2.247m0 0A9.015 9.015 0 013 12c0-1.605.42-3.113 1.157-4.418" />',
            'database' => '<path stroke-linecap="round" stroke-linejoin="round" d="M20.25 6.375c0 2.278-3.694 4.125-8.25 4.125S3.75 8.653 3.75 6.375m16.5 0c0-2.278-3.694-4.125-8.25-4.125S3.75 4.097 3.75 6.375m16.5 0v11.25c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125V6.375m16.5 0v3.75m-16.5-3.75v3.75m16.5 0v3.75C20.25 16.153 16.556 18 12 18s-8.25-1.847-8.25-4.125v-3.75m16.5 0c0 2.278-3.694 4.125-8.25 4.125s-8.25-1.847-8.25-4.125" />',
            'chart' => '<path stroke-linecap="round" stroke-linejoin="round" d="M3 13.125C3 12.504 3.504 12 4.125 12h2.25c.621 0 1.125.504 1.125 1.125v6.75C7.5 20.496 6.996 21 6.375 21h-2.25A1.125 1.125 0 013 19.875v-6.75zM9.75 8.625c0-.621.504-1.125 1.125-1.125h2.25c.621 0 1.125.504 1.125 1.125v11.25c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V8.625zM16.5 4.125c0-.621.504-1.125 1.125-1.125h2.25C20.496 3 21 3.504 21 4.125v15.75c0 .621-.504 1.125-1.125 1.125h-2.25a1.125 1.125 0 01-1.125-1.125V4.125z" />',
            'wifi' => '<path stroke-linecap="round" stroke-linejoin="round" d="M8.288 15.038a5.25 5.25 0 017.424 0M5.106 11.856c3.807-3.808 9.98-3.808 13.788 0M1.924 8.674c5.565-5.565 14.587-5.565 20.152 0M12.53 18.22l-.53.53-.53-.53a.75.75 0 011.06 0z" />',
            'shield' => '<path stroke-linecap="round" stroke-linejoin="round" d="M7.864 4.243A7.5 7.5 0 0119.5 10.5c0 2.92-.556 5.709-1.568 8.268M5.742 6.364A7.465 7.465 0 004.5 10.5a7.464 7.464 0 01-1.15 3.993m1.989 3.559A11.209 11.209 0 008.25 10.5a3.75 3.75 0 117.5 0c0 .527-.021 1.049-.064 1.565M12 10.5a14.94 14.94 0 01-3.6 9.75m6.633-4.596a18.666 18.666 0 01-2.485 5.33" />',
            'box' => '<path stroke-linecap="round" stroke-linejoin="round" d="M20.25 7.5l-.625 10.632a2.25 2.25 0 01-2.247 2.118H6.622a2.25 2.25 0 01-2.247-2.118L3.75 7.5M10 11.25h4M3.375 7.5h17.25c.621 0 1.125-.504 1.125-1.125v-1.5c0-.621-.504-1.125-1.125-1.125H3.375c-.621 0-1.125.504-1.125 1.125v1.5c0 .621.504 1.125 1.125 1.125z" />',
        ];
    }

    /**
     * Actualiza la página de servicios
     */
    public function serviciospage(Request $request)
    {
        $data = $request->all();

        // Guardar imágenes de atributos
        for ($bloque = 1; $bloque <= 3; $bloque++) {
            for ($i = 1; $i <= 4; $i++) {
                $field = "imagen_atributo{$i}_{$bloque}";
                if ($request->hasFile($field)) {
                    $file = $request->file($field);
                    $filename = time() . "_{$field}." . $file->getClientOriginalExtension();

                    $destinationPath = public_path('images/serviciospage');
                    if (!File::exists($destinationPath)) {
                        File::makeDirectory($destinationPath, 0755, true);
                    }

                    $file->move($destinationPath, $filename);
                    $data[$field] = "images/serviciospage/" . $filename;
                }
            }
        }

        // Guardar imágenes principales de bloque
        for ($j = 1; $j <= 4; $j++) {
            $field = "imagen{$j}";
            if ($request->hasFile($field)) {
                $file = $request->file($field);
                $filename = time() . "_{$field}." . $file->getClientOriginalExtension();

                $destinationPath = public_path('images/serviciospage');
                if (!File::exists($destinationPath)) {
                    File::makeDirectory($destinationPath, 0755, true);
                }

                $file->move($destinationPath, $filename);
                $data[$field] = "images/serviciospage/" . $filename;
            }
        }

        // Buscar el primer registro o crear uno nuevo si no existe
        $servicioPage = ServiciosPage::first();

        if ($servicioPage) {
            $servicioPage->update($data);
        } else {
            ServiciosPage::create($data);
        }

        return redirect()->back()->with('success', 'Contenido guardado correctamente.');
    }

    /**
     * Muestra un servicio específico en la vista pública
     */
    public function show($id, $slug = null)
    {
        // Obtener el servicio específico
        $servicio = Servicio::findOrFail($id);

        // Verificar si el slug proporcionado coincide con el nombre del servicio
        // Si no coincide, redirigir a la URL correcta (opcional, para SEO)
        $correctSlug = Str::slug($servicio->nombre);
        if ($slug !== $correctSlug) {
            return redirect()->route('servicios.show', ['id' => $id, 'slug' => $correctSlug]);
        }

        // Obtener servicios relacionados
        $relacionados = Servicio::where('id', '!=', $id)
            ->inRandomOrder()
            ->limit(3)
            ->get();

        // Retornar la vista con los datos
        return view('showservicio', compact('servicio', 'relacionados'));
    }
}
