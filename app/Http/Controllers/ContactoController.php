<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Contacto;
use App\Models\Faq;
use App\Models\Cotizacion;
use App\Models\HomepageContent;
use Illuminate\Support\Facades\Mail;

class ContactoController extends Controller
{
    /**
     * Muestra la página de contacto
     */
    public function index()
    {
        // Obtener el contenido dinámico para la página
        $content = Contacto::firstOrCreate([]);
        $homeContent = HomepageContent::firstOrCreate([]);
        
        // Obtener FAQs para mostrar en la página
        $faqs = Faq::where('activo', true)
            ->orderBy('orden')
            ->limit(4)
            ->get();
        
        return view('contacto', compact('content', 'homeContent', 'faqs'));
    }
    
    
    /* 
     * ==========================================================================
     * ADMINISTRACIÓN DE CONTENIDO
     * ==========================================================================
     */
    
    /**
     * Muestra el panel de administración de contenido
     */
    public function adminIndex()
    {
        $content = Contacto::firstOrCreate([]);
        $faqs = Faq::orderBy('orden')->paginate(10);
        
        return view('admin.contacto.index', compact('content', 'faqs'));
    }
    
    /**
     * Muestra la vista de edición de la configuración de contacto
     */
    public function adminEdit()
    {
        $content = Contacto::firstOrCreate([]);
        $faqs = Faq::orderBy('orden')->paginate(10);
        
        return view('admin.contacto.edit', compact('content', 'faqs'));
    }
    
    /**
     * Actualiza el contenido del sitio
     */
    public function adminUpdate(Request $request)
    {
        // Validar los datos
        $validated = $request->validate([
            'contact_tag' => 'nullable|string|max:255',
            'contact_title' => 'nullable|string|max:255',
            'contact_description' => 'nullable|string',
            'contact_phone' => 'nullable|string|max:255',
            'contact_email' => 'nullable|email|max:255',
            'contact_address' => 'nullable|string|max:255',
            'faq_button_text' => 'nullable|string|max:255',
            'faq_title' => 'nullable|string|max:255',
            'faq_description' => 'nullable|string',
        ]);
        
        // Obtener o crear el modelo de contacto
        $content = Contacto::firstOrCreate([]);
        
        // Actualizar cada campo
        foreach ($validated as $key => $value) {
            if (!is_null($value)) {
                $content->{$key} = $value;
            }
        }
        
        $content->save();
        
        // Redireccionar con mensaje de éxito
        return redirect()->route('admin.contacto.index')
            ->with('success', 'Configuración de contacto actualizada correctamente.');
    }
    
    /**
     * Obtiene los datos de una FAQ para edición vía AJAX
     */
    public function adminFaqsEdit($id)
    {
        $faq = Faq::findOrFail($id);
        return response()->json($faq);
    }
    
    /**
     * Almacena una nueva FAQ en la base de datos
     */
    public function adminFaqsStore(Request $request)
    {
        $validated = $request->validate([
            'pregunta' => 'required|string|max:255',
            'respuesta' => 'required|string',
            'categoria' => 'nullable|string|max:100',
            'orden' => 'nullable|integer',
        ]);
        
        // Si no se especificó un orden, usar el último + 1
        if (!isset($validated['orden'])) {
            $lastOrder = Faq::max('orden') ?? 0;
            $validated['orden'] = $lastOrder + 1;
        }
        
        // Asegurarse de que activo sea true si no se envía
        $validated['activo'] = $request->has('activo');
        
        // Crear la FAQ
        Faq::create($validated);
        
        return redirect()->route('admin.contacto.index', ['#faqs'])
            ->with('success', 'Pregunta frecuente creada correctamente.');
    }
    
    /**
     * Actualiza una FAQ en la base de datos
     */
    public function adminFaqsUpdate(Request $request, $id)
    {
        $faq = Faq::findOrFail($id);
        
        $validated = $request->validate([
            'pregunta' => 'required|string|max:255',
            'respuesta' => 'required|string',
            'categoria' => 'nullable|string|max:100',
            'orden' => 'nullable|integer',
        ]);
        
        // Asegurarse de que activo sea manejado correctamente
        $validated['activo'] = $request->has('activo');
        
        // Actualizar la FAQ
        $faq->update($validated);
        
        return redirect()->route('admin.contacto.index', ['#faqs'])
            ->with('success', 'Pregunta frecuente actualizada correctamente.');
    }
    
    /**
     * Elimina una FAQ de la base de datos
     */
    public function adminFaqsDestroy($id)
    {
        $faq = Faq::findOrFail($id);
        $faq->delete();
        
        return redirect()->route('admin.contacto.index', ['#faqs'])
            ->with('success', 'Pregunta frecuente eliminada correctamente.');
    }
    
    /**
     * Actualiza el orden de las FAQs
     */
    public function adminFaqsUpdateOrder(Request $request)
    {
        $items = $request->get('items');
        
        foreach ($items as $item) {
            Faq::where('id', $item['id'])->update(['orden' => $item['orden']]);
        }
        
        return response()->json(['success' => true]);
    }
    
}