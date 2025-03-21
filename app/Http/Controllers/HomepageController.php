<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomepageContent;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;

class HomepageController extends Controller
{
    /**
     * Mostrar la página de administración del contenido del Homepage
     */
    public function index()
    {
        $content = HomepageContent::firstOrCreate([]);

        // Inicializar la estructura de servicios si no existe
        if (!$content->services) {
            $content->services = [
                [
                    'title' => 'Cloud Computing',
                    'description' => 'Soluciones en la nube personalizadas para optimizar tus recursos y mejorar la escalabilidad.',
                    'icon' => ''
                ],
                [
                    'title' => 'DevOps',
                    'description' => 'Automatización y optimización del ciclo de desarrollo, integración y despliegue de software.',
                    'icon' => ''
                ],
                [
                    'title' => 'Ciberseguridad',
                    'description' => 'Protección integral de datos y sistemas críticos frente a amenazas y vulnerabilidades.',
                    'icon' => ''
                ]
            ];

            $content->save();
        }

        return view('admin.homepage.edit', compact('content'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'hero_tagline' => 'required|max:100',
            'hero_title_1' => 'required|max:100',
            'hero_title_2' => 'required|max:100',
            'hero_description' => 'required',
            'hero_bg_image' => 'nullable|image|max:2048',
            'stat_projects' => 'required|max:50',
            'stat_clients' => 'required|max:50',
            'stat_experts' => 'required|max:50',
            'stat_years' => 'required|max:50',
            'services_tag' => 'required|max:100',
            'services_title' => 'required|max:100',
            'services_description' => 'required',
            'services.*.title' => 'required|max:100',
            'services.*.description' => 'required',
            'services.*.icon' => 'nullable|image|max:1024',
            'contact_tag' => 'required|max:100',
            'contact_title' => 'required|max:100',
            'contact_description' => 'required',
            'contact_phone' => 'required|max:50',
            'contact_email' => 'required|email|max:100',
            'contact_address' => 'required|max:255',
        ]);

        $content = HomePageContent::first();
        if (!$content) {
            $content = new HomePageContent();
        }

        // Actualizar datos básicos
        $content->hero_tagline = $request->hero_tagline;
        $content->hero_title_1 = $request->hero_title_1;
        $content->hero_title_2 = $request->hero_title_2;
        $content->hero_description = $request->hero_description;

        // Estadísticas
        $content->stat_projects = $request->stat_projects;
        $content->stat_clients = $request->stat_clients;
        $content->stat_experts = $request->stat_experts;
        $content->stat_years = $request->stat_years;

        // Sección servicios
        $content->services_tag = $request->services_tag;
        $content->services_title = $request->services_title;
        $content->services_description = $request->services_description;

        // Sección contacto
        $content->contact_tag = $request->contact_tag;
        $content->contact_title = $request->contact_title;
        $content->contact_description = $request->contact_description;
        $content->contact_phone = $request->contact_phone;
        $content->contact_email = $request->contact_email;
        $content->contact_address = $request->contact_address;

        // Proceso de imagen de fondo si se ha subido una nueva
        if ($request->hasFile('hero_bg_image')) {
            $imageFile = $request->file('hero_bg_image');
            $imageName = 'hero-bg-' . time() . '.' . $imageFile->getClientOriginalExtension();

            // Guardar el archivo
            $imagePath = $imageFile->move(public_path('storage/images'), $imageName);
            $content->hero_bg_image = 'storage/images/' . $imageName;
        }

        // Procesar servicios dinámicos
        $services = [];

        if ($request->has('services') && is_array($request->services)) {
            foreach ($request->services as $index => $serviceData) {
                // Verificar que tenga los campos requeridos
                if (isset($serviceData['title']) && isset($serviceData['description'])) {
                    $service = [
                        'title' => $serviceData['title'],
                        'description' => $serviceData['description']
                    ];

                    // Mantener el icono existente si no se carga uno nuevo
                    if (isset($serviceData['existing_icon']) && !empty($serviceData['existing_icon'])) {
                        $service['icon'] = $serviceData['existing_icon'];
                    }

                    // Procesar el nuevo icono si se ha subido
                    if (isset($request->files->all()['services'][$index]['icon'])) {
                        $iconFile = $request->files->all()['services'][$index]['icon'];
                        $iconName = 'service-icon-' . ($index + 1) . '-' . time() . '.' . $iconFile->getClientOriginalExtension();

                        // Asegurarse de que el directorio existe
                        $iconPath = public_path('storage/images/icons');
                        if (!file_exists($iconPath)) {
                            mkdir($iconPath, 0755, true);
                        }

                        // Guardar el archivo
                        $iconFile->move($iconPath, $iconName);
                        $service['icon'] = 'storage/images/icons/' . $iconName;
                    }

                    $services[] = $service;
                }
            }
        }

        // Asegurar que siempre haya al menos un servicio
        if (empty($services)) {
            $services[] = [
                'title' => 'Servicio por defecto',
                'description' => 'Por favor, actualice este servicio con su información.'
            ];
        }

        $content->services = $services;
        $content->save();

        return redirect()->route('admin.homepage.index')->with('success', 'El contenido de la página de inicio ha sido actualizado correctamente.');
    }
    /**
     * Método auxiliar para obtener la URL del icono de un servicio
     */
    public function getServiceIconUrl($index)
    {
        $content = HomePageContent::first();

        if (!$content || !isset($content->services[$index]['icon'])) {
            return null;
        }

        $iconPath = $content->services[$index]['icon'];

        // Si la ruta ya comienza con 'http' o '//' es una URL completa
        if (strpos($iconPath, 'http') === 0 || strpos($iconPath, '//') === 0) {
            return $iconPath;
        }

        // Si no, considerar como ruta relativa y convertir a URL completa
        return asset($iconPath);
    }
}
