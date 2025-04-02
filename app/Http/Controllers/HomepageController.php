<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HomepageContent;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Models\PartnerTecnologico;
use App\Models\Testimonio; // Asegúrate de tener este modelo

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
        $partners = PartnerTecnologico::first();
        if (!$partners) {
            $partners = new PartnerTecnologico();
        }

        return view('admin.homepage.edit', compact('content', 'partners'));
    }

    public function update(Request $request)
    {
        // Actualizar la página de inicio
        $content = HomepageContent::first();
        if (!$content) {
            $content = new HomepageContent();
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

        // Add testimonios section fields
        $content->testimonios_tag = $request->testimonios_tag;
        $content->testimonios_title = $request->testimonios_title;
        $content->testimonios_description = $request->testimonios_description;

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

        // Actualizar Partners Tecnológicos
        $partners = PartnerTecnologico::first();
        if (!$partners) {
            $partners = new PartnerTecnologico();
        }

        // Datos generales de partners
        $partners->tagline = $request->tagline;
        $partners->h2 = $request->h2;
        $partners->contenido = $request->contenido;

        // Procesar las 8 tarjetas de partners
        for ($i = 1; $i <= 8; $i++) {
            // Guardar título, tag y posición para cada tarjeta
            $partners->{"titulo_tarjeta{$i}"} = $request->{"titulo_tarjeta{$i}"};
            $partners->{"tag{$i}"} = $request->{"tag{$i}"};
            $partners->{"posicion{$i}"} = $request->{"posicion{$i}"};

            // Procesar logo si se ha subido uno nuevo
            if ($request->hasFile("logo{$i}")) {
                $logoFile = $request->file("logo{$i}");
                $logoName = "partner-logo-{$i}-" . time() . '.' . $logoFile->getClientOriginalExtension();

                // Asegurarse de que el directorio existe
                $logoPath = public_path('storage/images/partners');
                if (!file_exists($logoPath)) {
                    mkdir($logoPath, 0755, true);
                }

                // Guardar el archivo
                $logoFile->move($logoPath, $logoName);
                $partners->{"logo{$i}"} = 'storage/images/partners/' . $logoName;
            }
        }

        // Actualizar datos del Ecosistema
        $partners->tagline2 = $request->tagline2;
        $partners->h2_2 = $request->h2_2;
        $partners->contenido2 = $request->contenido2;

        // Tarjetas del ecosistema
        $partners->titulo_tarjeta_eco1 = $request->titulo_tarjeta_eco1;
        $partners->subtitulo_eco1 = $request->subtitulo_eco1;
        $partners->lista_tarjeta_eco1 = $request->lista_tarjeta_eco1;

        $partners->titulo_tarjeta_eco2 = $request->titulo_tarjeta_eco2;
        $partners->subtitulo_eco2 = $request->subtitulo_eco2;
        $partners->lista_tarjeta_eco2 = $request->lista_tarjeta_eco2;

        $partners->titulo_tarjeta_eco3 = $request->titulo_tarjeta_eco3;
        $partners->subtitulo_eco3 = $request->subtitulo_eco3;
        $partners->lista_tarjeta_eco3 = $request->lista_tarjeta_eco3;

        $partners->save();

        return redirect()->route('admin.homepage.index')->with('success', 'El contenido de la página de inicio ha sido actualizado correctamente.');
    }

    /**
     * Método auxiliar para obtener la URL del icono de un servicio
     */
    public function getServiceIconUrl($index)
    {
        $content = HomepageContent::first();

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

    /*===============================================================
     * Funciones para la gestión de testimonios
     *===============================================================*/

    /**
     * Listar testimonios
     */
    public function testimoniosIndex()
    {
        $testimonios = Testimonio::all();
        return view('admin.testimonios.index', compact('testimonios'));
    }

    /**
     * Mostrar formulario para crear testimonio
     */
    public function testimoniosCreate()
    {
        return view('admin.testimonios.form');
    }

    /**
     * Almacenar testimonio
     */
    public function testimoniosStore(Request $request)
    {
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'cargo' => 'required|string|max:255',
            'contenido' => 'required|string',
            'numero_de_estrellas' => 'required|integer|min:1|max:5',
        ]);

        Testimonio::create($validated);

        return redirect()->route('admin.homepage.testimonios.index')
            ->with('success', 'Testimonio creado correctamente.');
    }

    /**
     * Mostrar formulario para editar testimonio
     */
    public function testimoniosEdit($id)
    {
        $testimonio = Testimonio::findOrFail($id);
        return view('admin.testimonios.form', compact('testimonio'));
    }

    /**
     * Actualizar testimonio
     */
    public function testimoniosUpdate(Request $request, $id)
    {
        $testimonio = Testimonio::findOrFail($id);
        $validated = $request->validate([
            'nombre' => 'required|string|max:255',
            'cargo' => 'required|string|max:255',
            'contenido' => 'required|string',
            'numero_de_estrellas' => 'required|integer|min:1|max:5',
        ]);

        $testimonio->update($validated);

        return redirect()->route('admin.homepage.testimonios.index')
            ->with('success', 'Testimonio actualizado correctamente.');
    }

    public function testimoniosConfigUpdate(Request $request)
    {
        // Debug: Log all incoming request data
        \Log::info('Testimonios Config Update Request', [
            'all_data' => $request->all(),
            'route_name' => \Request::route()->getName()
        ]);

        $content = HomepageContent::first() ?? new HomepageContent();
        $content->testimonios_tag = $request->testimonios_tag;
        $content->testimonios_title = $request->testimonios_title;
        $content->testimonios_description = $request->testimonios_description;
        $content->save();

        return redirect()->route('admin.homepage.testimonios.index')->with('success', 'Configuración de testimonios actualizada.');
    }

    /**
     * Eliminar testimonio
     */
    public function testimoniosDestroy($id)
    {
        $testimonio = Testimonio::findOrFail($id);
        $testimonio->delete();
        return redirect()->route('admin.homepage.testimonios.index')
            ->with('success', 'Testimonio eliminado correctamente.');
    }
}
