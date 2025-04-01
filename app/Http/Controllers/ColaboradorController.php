<?php

namespace App\Http\Controllers;

use App\Models\Colaborador;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log; // Añade esta línea para importar Log

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
        Log::info('Iniciando método store de ColaboradorController');
        Log::info('Datos recibidos:', $request->all());

        try {
            $request->validate([
                'nombre' => 'required|string|max:255',
                'cargo' => 'required|string|max:255',
                'departamento' => 'nullable|string|max:255',
                'linkedin' => 'nullable|string|max:255',
                'descripcion' => 'nullable|string',
                'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            ]);

            Log::info('Validación pasada correctamente');
            
            $data = $request->only(['nombre', 'cargo', 'departamento', 'linkedin', 'descripcion']);
            Log::info('Datos a guardar (sin imagen):', $data);

            // Procesar imagen personalizada
            if ($request->hasFile('imagen')) {
                Log::info('Se ha detectado una imagen');
                
                $imagen = $request->file('imagen');
                $nombreImagen = 'colaboradores/' . time() . '-' . Str::slug($request->nombre) . '.' . $imagen->getClientOriginalExtension();
                
                try {
                    Log::info('Intentando mover la imagen a: ' . public_path('images/colaboradores'));
                    
                    // Verificar si el directorio existe, si no, crearlo
                    if (!File::exists(public_path('images/colaboradores'))) {
                        Log::info('Directorio no existe, creándolo');
                        File::makeDirectory(public_path('images/colaboradores'), 0755, true);
                    }
                    
                    $imagen->move(public_path('images/colaboradores'), $nombreImagen);
                    $data['imagen'] = 'images/' . $nombreImagen;
                    
                    Log::info('Imagen guardada correctamente en: ' . $data['imagen']);
                } catch (\Exception $e) {
                    Log::error('Error al guardar la imagen: ' . $e->getMessage());
                }
            } else {
                Log::info('No se ha incluido imagen');
            }

            Log::info('Intentando crear el colaborador con datos:', $data);
            $colaborador = Colaborador::create($data);
            
            if ($colaborador) {
                Log::info('Colaborador creado exitosamente con ID: ' . $colaborador->id);
            } else {
                Log::error('No se pudo crear el colaborador. No se devolvió instancia.');
            }

            return redirect()->route('admin.colaboradores.index')
                ->with('success', 'Colaborador creado exitosamente.');
                
        } catch (\Exception $e) {
            Log::error('Error en store de ColaboradorController: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return redirect()->back()
                ->with('error', 'Error al crear el colaborador: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Actualiza un colaborador existente.
     */
    public function update(Request $request, $id)
    {
        Log::info('Iniciando método update de ColaboradorController para ID: ' . $id);
        Log::info('Datos recibidos:', $request->all());
        
        try {
            $request->validate([
                'nombre' => 'required|string|max:255',
                'cargo' => 'required|string|max:255',
                'departamento' => 'nullable|string|max:255',
                'linkedin' => 'nullable|string|max:255',
                'descripcion' => 'nullable|string',
                'imagen' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
            ]);
            
            Log::info('Validación pasada correctamente');
            
            $colaborador = Colaborador::findOrFail($id);
            Log::info('Colaborador encontrado:', $colaborador->toArray());
            
            $data = $request->only(['nombre', 'cargo', 'departamento', 'linkedin', 'descripcion']);
            Log::info('Datos a actualizar (sin imagen):', $data);
            
            if ($request->hasFile('imagen')) {
                Log::info('Se ha detectado una nueva imagen');
                
                $imagen = $request->file('imagen');
                $nombreImagen = 'colaboradores/' . time() . '-' . Str::slug($request->nombre) . '.' . $imagen->getClientOriginalExtension();
                
                try {
                    if (!File::exists(public_path('images/colaboradores'))) {
                        File::makeDirectory(public_path('images/colaboradores'), 0755, true);
                    }
                    
                    $imagen->move(public_path('images/colaboradores'), $nombreImagen);
                    $data['imagen'] = 'images/' . $nombreImagen;
                    
                    Log::info('Nueva imagen guardada correctamente en: ' . $data['imagen']);
                } catch (\Exception $e) {
                    Log::error('Error al guardar la nueva imagen: ' . $e->getMessage());
                }
            }
            
            $colaborador->update($data);
            Log::info('Colaborador actualizado correctamente');
            
            return redirect()->route('admin.colaboradores.index')
                ->with('success', 'Colaborador actualizado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error en update de ColaboradorController: ' . $e->getMessage());
            Log::error('Stack trace: ' . $e->getTraceAsString());
            
            return redirect()->back()
                ->with('error', 'Error al actualizar el colaborador: ' . $e->getMessage())
                ->withInput();
        }
    }

    /**
     * Elimina un colaborador.
     */
    public function destroy($id)
    {
        Log::info('Iniciando método destroy de ColaboradorController para ID: ' . $id);
        
        try {
            $colaborador = Colaborador::findOrFail($id);
            Log::info('Colaborador encontrado:', $colaborador->toArray());
            
            $colaborador->delete();
            Log::info('Colaborador eliminado correctamente');
            
            return redirect()->route('admin.colaboradores.index')
                ->with('success', 'Colaborador eliminado correctamente.');
        } catch (\Exception $e) {
            Log::error('Error en destroy de ColaboradorController: ' . $e->getMessage());
            
            return redirect()->back()
                ->with('error', 'Error al eliminar el colaborador: ' . $e->getMessage());
        }
    }
}