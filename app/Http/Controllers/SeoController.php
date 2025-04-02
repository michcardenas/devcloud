<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\SeoMetadata;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SeoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $seoMetadata = SeoMetadata::orderBy('id', 'desc')->get();
        return view('admin.seo.index', compact('seoMetadata'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'page_slug' => 'required|unique:seo_metadata|max:255',
            'meta_title' => 'nullable|max:255',
            'meta_description' => 'nullable',
            'meta_keywords' => 'nullable',
            'meta_robots' => 'nullable|max:100',
            'canonical_url' => 'nullable|url|max:255',
            'og_title' => 'nullable|max:255',
            'og_description' => 'nullable',
            'og_image' => 'nullable|url|max:255',
            'og_type' => 'nullable|max:50',
            'og_url' => 'nullable|url|max:255',
            'og_site_name' => 'nullable|max:100',
            'og_locale' => 'nullable|max:10',
            'twitter_card' => 'nullable|max:50',
            'twitter_title' => 'nullable|max:255',
            'twitter_description' => 'nullable',
            'twitter_image' => 'nullable|url|max:255',
            'twitter_image_alt' => 'nullable|max:255',
            'twitter_site' => 'nullable|max:100',
            'twitter_creator' => 'nullable|max:100',
            'language_code' => 'nullable|max:10',
        ]);

        try {
            SeoMetadata::create($validated);
            return redirect()->route('admin.seo.index')->with('success', 'Metadatos SEO creados exitosamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al crear los metadatos SEO: ' . $e->getMessage());
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(SeoMetadata $seo)
    {
        return view('admin.seo.index', [
            'seoMetadata' => SeoMetadata::orderBy('id', 'desc')->get(),
            'editSeo' => $seo
        ]);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, SeoMetadata $seo)
    {
        $validated = $request->validate([
            'page_slug' => [
                'required',
                'max:255',
                Rule::unique('seo_metadata')->ignore($seo->id),
            ],
            'meta_title' => 'nullable|max:255',
            'meta_description' => 'nullable',
            'meta_keywords' => 'nullable',
            'meta_robots' => 'nullable|max:100',
            'canonical_url' => 'nullable|url|max:255',
            'og_title' => 'nullable|max:255',
            'og_description' => 'nullable',
            'og_image' => 'nullable|url|max:255',
            'og_type' => 'nullable|max:50',
            'og_url' => 'nullable|url|max:255',
            'og_site_name' => 'nullable|max:100',
            'og_locale' => 'nullable|max:10',
            'twitter_card' => 'nullable|max:50',
            'twitter_title' => 'nullable|max:255',
            'twitter_description' => 'nullable',
            'twitter_image' => 'nullable|url|max:255',
            'twitter_image_alt' => 'nullable|max:255',
            'twitter_site' => 'nullable|max:100',
            'twitter_creator' => 'nullable|max:100',
            'language_code' => 'nullable|max:10',
        ]);

        try {
            $seo->update($validated);
            return redirect()->route('admin.seo.index')->with('success', 'Metadatos SEO actualizados exitosamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al actualizar los metadatos SEO: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(SeoMetadata $seo)
    {
        try {
            $seo->delete();
            return redirect()->route('admin.seo.index')->with('success', 'Metadatos SEO eliminados exitosamente.');
        } catch (\Exception $e) {
            return back()->with('error', 'Error al eliminar los metadatos SEO: ' . $e->getMessage());
        }
    }

    /**
     * Genera automáticamente metadatos SEO para una página específica
     */
    public function generate(Request $request)
    {
        $request->validate([
            'page_slug' => 'required|string|max:255',
            'page_title' => 'required|string|max:255',
            'page_content' => 'nullable|string',
        ]);

        $slug = $request->page_slug;
        $title = $request->page_title;
        $content = $request->page_content ?? '';

        // Si ya existe un registro para esta página, lo actualizamos
        $seo = SeoMetadata::where('page_slug', $slug)->first();
        if (!$seo) {
            $seo = new SeoMetadata();
            $seo->page_slug = $slug;
        }

        // Generamos metadatos básicos
        $seo->meta_title = $title;
        
        // Descripción: extraemos primeros 160 caracteres del contenido, o generamos algo genérico
        if (!empty($content)) {
            $description = strip_tags($content);
            $description = preg_replace('/\s+/', ' ', $description); // Eliminar espacios múltiples
            $description = substr($description, 0, 157) . '...';
        } else {
            $description = "Información sobre " . $title . " - DevCloud";
        }
        $seo->meta_description = $description;
        
        // Palabras clave: extraemos palabras importantes del título
        $keywords = strtolower($title);
        $keywords = preg_replace('/[^\p{L}\p{N}\s]/u', '', $keywords); // Solo letras, números y espacios
        $words = explode(' ', $keywords);
        $keywords = array_filter($words, function($word) {
            return strlen($word) > 3; // Solo palabras con más de 3 caracteres
        });
        $seo->meta_keywords = implode(', ', $keywords) . ', devcloud';
        
        // Establecemos valores por defecto para OG y Twitter Card
        $seo->og_title = $title;
        $seo->og_description = $description;
        $seo->og_type = 'website';
        $seo->og_site_name = 'DevCloud';
        
        $seo->twitter_card = 'summary_large_image';
        $seo->twitter_title = $title;
        $seo->twitter_description = $description;
        
        // Guardamos los cambios
        $seo->save();
        
        return redirect()->route('admin.seo.index')
            ->with('success', 'Metadatos SEO generados automáticamente para la página "' . $title . '"');
    }

    /**
     * Muestra una previsualización de cómo se verán los metadatos en los resultados de búsqueda
     */
    public function preview(SeoMetadata $seo)
    {
        return view('admin.seo.preview', compact('seo'));
    }

    /**
     * Permite importar metadatos SEO desde un archivo CSV
     */
    public function import(Request $request)
    {
        $request->validate([
            'csv_file' => 'required|file|mimes:csv,txt|max:2048',
        ]);

        $file = $request->file('csv_file');
        $path = $file->getRealPath();

        $csvData = array_map('str_getcsv', file($path));
        $headers = array_shift($csvData);

        // Validamos que el archivo tenga al menos las columnas necesarias
        $requiredColumns = ['page_slug', 'meta_title', 'meta_description'];
        $missingColumns = array_diff($requiredColumns, $headers);

        if (!empty($missingColumns)) {
            return back()->with('error', 'El archivo CSV no contiene las columnas requeridas: ' . implode(', ', $missingColumns));
        }

        $imported = 0;
        $errors = 0;

        foreach ($csvData as $row) {
            $data = array_combine($headers, $row);
            
            // Validamos que tenga al menos un slug
            if (empty($data['page_slug'])) {
                $errors++;
                continue;
            }

            try {
                // Si existe actualizamos, sino creamos
                $seo = SeoMetadata::updateOrCreate(
                    ['page_slug' => $data['page_slug']],
                    $data
                );
                $imported++;
            } catch (\Exception $e) {
                $errors++;
            }
        }

        if ($errors > 0) {
            $message = "Importación completada con advertencias: $imported registros importados, $errors con errores.";
            return back()->with('warning', $message);
        }

        return back()->with('success', "Importación exitosa: $imported registros de SEO importados correctamente.");
    }

    /**
     * Permite exportar todos los metadatos SEO a un archivo CSV
     */
    public function export()
    {
        $seoData = SeoMetadata::all();
        
        $headers = [
            'Content-Type' => 'text/csv',
            'Content-Disposition' => 'attachment; filename="seo_metadata_export_' . date('Y-m-d') . '.csv"',
        ];

        $callback = function() use ($seoData) {
            $file = fopen('php://output', 'w');
            
            // Cabeceras CSV
            fputcsv($file, [
                'page_slug',
                'meta_title',
                'meta_description',
                'meta_keywords',
                'meta_robots',
                'canonical_url',
                'og_title',
                'og_description',
                'og_image',
                'og_type',
                'og_url',
                'og_site_name',
                'og_locale',
                'twitter_card',
                'twitter_title',
                'twitter_description',
                'twitter_image',
                'twitter_image_alt',
                'twitter_site',
                'twitter_creator',
                'language_code'
            ]);
            
            foreach ($seoData as $seo) {
                fputcsv($file, [
                    $seo->page_slug,
                    $seo->meta_title,
                    $seo->meta_description,
                    $seo->meta_keywords,
                    $seo->meta_robots,
                    $seo->canonical_url,
                    $seo->og_title,
                    $seo->og_description,
                    $seo->og_image,
                    $seo->og_type,
                    $seo->og_url,
                    $seo->og_site_name,
                    $seo->og_locale,
                    $seo->twitter_card,
                    $seo->twitter_title,
                    $seo->twitter_description,
                    $seo->twitter_image,
                    $seo->twitter_image_alt,
                    $seo->twitter_site,
                    $seo->twitter_creator,
                    $seo->language_code
                ]);
            }
            
            fclose($file);
        };
        
        return response()->stream($callback, 200, $headers);
    }
}