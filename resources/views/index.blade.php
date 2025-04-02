@extends('layouts.app')

@section('title', 'Helmcode - Soluciones en la Nube y DevOps')

@section('content')

<!-- Hero Section con estadísticas -->
<section class="hero-section scroll-reveal" data-bg-image="{{ $content->hero_bg_image ? asset($content->hero_bg_image) : '/images/cloud-dark-bg.jpg' }}">
    <div class="hero-container">
        <div class="hero-content scroll-reveal delay-1">
            <span class="tag-line scroll-reveal delay-2">{{ $content->hero_tagline }}</span>
            <h1 class="hero-title scroll-reveal delay-2">{{ $content->hero_title_1 }} <span class="highlight"><span class="highlight">{{ $content->hero_title_2 }}</span></h1>

            <p class="hero-description scroll-reveal delay-3">{{ $content->hero_description }}</p>

            <div class="hero-buttons scroll-reveal delay-4">
                <button type="button" class="btn btn-primary" onclick="location.href='#contacto'">
                    Solicitar consulta <span class="arrow-icon">→</span>
                </button>
                <button type="button" class="btn btn-secondary" onclick="location.href='#servicios'">
                    Nuestros servicios
                </button>
            </div>
        </div>

        <div class="stats-card scroll-reveal from-right delay-3">
            <div class="stats-row">
                <div class="stat-box">
                    <span class="stat-label">Proyectos completados</span>
                    <div class="stat-value">{{ $content->stat_projects }}</div>
                    <div class="stat-bar"></div>
                </div>
                <div class="stat-box">
                    <span class="stat-label">Clientes satisfechos</span>
                    <div class="stat-value">{{ $content->stat_clients }}</div>
                    <div class="stat-bar"></div>
                </div>
            </div>
            <div class="stats-row">
                <div class="stat-box">
                    <span class="stat-label">Expertos certificados</span>
                    <div class="stat-value">{{ $content->stat_experts }}</div>
                    <div class="stat-bar"></div>
                </div>
                <div class="stat-box">
                    <span class="stat-label">Años de experiencia</span>
                    <div class="stat-value">{{ $content->stat_years }}</div>
                    <div class="stat-bar"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Sección de Servicios actualizada con generación dinámica -->
<section id="servicios" class="py-20 bg-services text-center relative">
    <!-- Formas geométricas disruptivas -->
    <div class="shape-disruptor shape-1"></div>
    <div class="shape-disruptor shape-2"></div>

    <div class="container mx-auto px-4">
        <span class="services-tag scroll-reveal">{{ $content->services_tag }}</span>
        <h2 class="services-title scroll-reveal">{{ $content->services_title }}</h2>
        <p class="services-description scroll-reveal delay-1">
            {{ $content->services_description }}
        </p>

        <div class="services-grid">
            @forelse($content->services as $index => $service)
                <!-- Tarjeta de Servicio {{ $index + 1 }} -->
                <div class="service-card scroll-reveal delay-{{ min($index + 1, 3) }}"
                     onclick="scrollToContacto('{{ $service['title'] ?? 'Servicio ' . ($index + 1) }}')"
                     style="cursor: pointer;">
                    <img src="{{ !empty($service['icon']) ? asset($service['icon']) : '/images/default_service_' . (($index % 3) + 1) . '.png' }}" 
                         alt="{{ $service['title'] ?? 'Servicio ' . ($index + 1) }}">
                    <h3>{{ $service['title'] ?? 'Servicio ' . ($index + 1) }}</h3>
                    <p>{{ $service['description'] ?? 'Descripción del servicio ' . ($index + 1) }}</p>
                    <span class="more-info">
                        Más información
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14"></path>
                            <path d="m12 5 7 7-7 7"></path>
                        </svg>
                    </span>
                </div>
            @empty
                <!-- Mostrar mensaje o servicios predeterminados si no hay servicios configurados -->
                <div class="service-card scroll-reveal delay-1"
                     onclick="scrollToContacto('Servicio 1')" style="cursor: pointer;">
                    <img src="/images/cloud_done_24dp_E3E3E3_FILL0_wght400_GRAD0_opsz24.png" alt="Servicio 1">
                    <h3>Servicio 1</h3>
                    <p>Descripción del servicio predeterminado 1</p>
                    <span class="more-info">
                        Más información
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M5 12h14"></path>
                            <path d="m12 5 7 7-7 7"></path>
                        </svg>
                    </span>
                </div>
            @endforelse
        </div>
    </div>
</section>

<section class="bg-[#0B1120] py-20 text-white text-center">
    <span class="text-sm bg-cyan-900 text-cyan-300 px-3 py-1 rounded-full mb-4 inline-block">
        {{ $content->testimonios_tag ?? 'Testimonios' }}
    </span>
    <h2 class="text-3xl md:text-4xl font-bold mb-2">
        {{ $content->testimonios_title ?? 'Lo que dicen nuestros clientes' }}
    </h2>
    <p class="text-gray-400 max-w-xl mx-auto mb-10">
        {{ $content->testimonios_description ?? 'Descubre por qué las empresas confían en nosotros para sus necesidades tecnológicas.' }}
    </p>

    <div class="swiper mySwiper max-w-xl mx-auto overflow-hidden">
        <div class="swiper-wrapper">
            @foreach($testimonios as $testimonio)
                <div class="swiper-slide bg-[#1E293B] rounded-xl p-8 shadow-lg">
                    <p class="text-gray-300 italic mb-4">
                        "{{ $testimonio->contenido }}"
                    </p>
                    <div class="text-yellow-400 mb-4 text-lg">
                        {!! str_repeat('★', $testimonio->numero_de_estrellas) !!}
                        {!! str_repeat('☆', 5 - $testimonio->numero_de_estrellas) !!}
                    </div>
                    <div class="text-white font-semibold">{{ $testimonio->nombre }}</div>
                    <div class="text-cyan-400 text-sm">{{ $testimonio->cargo }}</div>
                </div>
            @endforeach
        </div>

        <!-- Paginación -->
        <div class="swiper-pagination mt-6"></div>
    </div>
</section>



<section class="partners-section py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <!-- Encabezado de la sección -->
        <div class="text-center mb-12">
            <span class="inline-block px-4 py-1 bg-cyan-50 text-cyan-600 rounded-full text-sm font-medium mb-3">
                {{ $partners->tagline ?? 'Nuestros colaboradores' }}
            </span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                {{ $partners->h2 ?? 'Partners tecnológicos de confianza' }}
            </h2>
            <p class="max-w-3xl mx-auto text-gray-600">
                {{ $partners->contenido ?? 'Colaboramos con los líderes del sector tecnológico para ofrecer soluciones integrales y de máxima calidad para nuestros clientes.' }}
            </p>
        </div>

        <!-- Filtros de categoría -->
        <div class="flex flex-wrap justify-center gap-2 mb-10">
            <button type="button" class="filter-btn active px-6 py-2 bg-cyan-500 text-white rounded-full hover:bg-cyan-600 transition" data-filter="todos">
                Todos
            </button>
            <button type="button" class="filter-btn px-6 py-2 bg-white text-gray-700 rounded-full hover:bg-gray-100 transition" data-filter="platinum">
                Platinum
            </button>
            <button type="button" class="filter-btn px-6 py-2 bg-white text-gray-700 rounded-full hover:bg-gray-100 transition" data-filter="gold">
                Gold
            </button>
            <button type="button" class="filter-btn px-6 py-2 bg-white text-gray-700 rounded-full hover:bg-gray-100 transition" data-filter="silver">
                Silver
            </button>
        </div>

        <!-- Cuadrícula de partners -->
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6 partner-grid">
            @php
                // Para depuración, revisemos los datos de cada partner
                echo "<!-- Debugging partner data: -->";
                
                $partnerItems = [];
                
                // Recopilar información de los partners desde 1 hasta 8
                for ($i = 1; $i <= 8; $i++) {
                    $logo = $partners->{"logo$i"} ?? '';
                    $titulo = $partners->{"titulo_tarjeta$i"} ?? '';
                    $tag = $partners->{"tag$i"} ?? '';
                    $posicion = $partners->{"posicion$i"} ?? '';
                    
                    echo "<!-- Partner $i: Título='$titulo', Tag='$tag', Posición='$posicion', Logo='$logo' -->";
                    
                    // Solo agregar si tiene título y posición
                    if (!empty($titulo) && !empty($posicion)) {
                        $partnerItems[] = [
                            'logo' => $logo,
                            'titulo' => $titulo,
                            'tag' => $tag,
                            'posicion' => $posicion,
                            'index' => $i  // Agregamos el índice para depuración
                        ];
                        echo "<!-- ✅ Partner $i añadido al array -->";
                    } else {
                        echo "<!-- ❌ Partner $i NO añadido (falta título o posición) -->";
                    }
                }
                
                echo "<!-- Total partners añadidos: " . count($partnerItems) . " -->";
            @endphp

            @foreach($partnerItems as $partner)
              <!-- Modificación para la tarjeta de partner individual -->
<div class="partner-card bg-white rounded-lg shadow-sm overflow-hidden transition-transform hover:shadow-md partner-item {{ $partner['posicion'] }}">
    <div class="p-6 text-center">
        @if(!empty($partner['logo']))
            <div class="partner-logo-container">
                <img src="{{ asset($partner['logo']) }}" alt="{{ $partner['titulo'] }}" class="partner-logo">
            </div>
        @endif
        <h3 class="text-xl font-semibold text-gray-800 mb-1">{{ $partner['titulo'] }}</h3>
        @if(!empty($partner['tag']))
            <p class="text-gray-500 text-sm mb-3">{{ $partner['tag'] }}</p>
        @endif
        
        <div class="mt-4">
            <span class="inline-block px-3 py-1 text-xs font-medium rounded-full
                @if($partner['posicion'] == 'platinum')
                    bg-indigo-100 text-indigo-800
                @elseif($partner['posicion'] == 'gold')
                    bg-yellow-100 text-yellow-800
                @else
                    bg-gray-100 text-gray-800
                @endif
            ">
                {{ ucfirst($partner['posicion']) }} Partner
            </span>
        </div>
    </div>
</div>
            @endforeach
        </div>
    </div>
</section>

<section class="partners-program-section py-16 bg-gray-50">
    <div class="container mx-auto px-4">
        <!-- Encabezado de la sección -->
        <div class="text-center mb-12">
            <span class="inline-block px-4 py-1 bg-cyan-50 text-cyan-600 rounded-full text-sm font-medium mb-3">
                {{ $partners->tagline2 ?? 'Programa de Partners' }}
            </span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                {{ $partners->h2_2 ?? 'Forma parte de nuestro ecosistema' }}
            </h2>
            <p class="max-w-3xl mx-auto text-gray-600 mb-8">
                {{ $partners->contenido2 ?? 'Potencia tu negocio uniéndote a nuestro programa de partners. Trabajemos juntos para crear soluciones innovadoras y abrir nuevas oportunidades de mercado.' }}
            </p>
        </div>

        <!-- Tarjetas de niveles de partnership -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-12">
    <!-- Nivel Platinum -->
    <div class="rounded-lg overflow-hidden border border-indigo-100 shadow-sm">
        <div class="p-5 bg-indigo-50">
            <h3 class="text-xl font-bold text-gray-900 mb-1">
                {{ $partners->titulo_tarjeta_eco1 ?? 'Platinum' }}
            </h3>
            <p class="text-indigo-600">
                {{ $partners->subtitulo_eco1 ?? 'Colaboración estratégica' }}
            </p>
        </div>
        <div class="p-5 bg-white">
            <ul class="space-y-3">
                @if(!empty($partners->lista_tarjeta_eco1))
                    @foreach(explode("\n", $partners->lista_tarjeta_eco1) as $item)
                        @if(!empty(trim($item)))
                        <li class="flex items-start">
                            <svg class="w-4 h-4 text-indigo-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-gray-700">{{ trim($item) }}</span>
                        </li>
                        @endif
                    @endforeach
                @else
                    <li class="flex items-start">
                        <svg class="w-4 h-4 text-indigo-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-gray-700">Acceso prioritario a eventos exclusivos</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-4 h-4 text-indigo-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-gray-700">Desarrollo conjunto de soluciones</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-4 h-4 text-indigo-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-gray-700">Equipo de soporte dedicado 24/7</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-4 h-4 text-indigo-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-gray-700">Posición destacada en nuestra web y materiales</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-4 h-4 text-indigo-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-gray-700">Acceso a nuestro programa de innovación</span>
                    </li>
                @endif
            </ul>
        </div>
    </div>
    
    <!-- Nivel Gold -->
    <div class="rounded-lg overflow-hidden border border-yellow-100 shadow-sm">
        <div class="p-5 bg-yellow-50">
            <h3 class="text-xl font-bold text-gray-900 mb-1">
                {{ $partners->titulo_tarjeta_eco2 ?? 'Gold' }}
            </h3>
            <p class="text-yellow-600">
                {{ $partners->subtitulo_eco2 ?? 'Alianza avanzada' }}
            </p>
        </div>
        <div class="p-5 bg-white">
            <ul class="space-y-3">
                @if(!empty($partners->lista_tarjeta_eco2))
                    @foreach(explode("\n", $partners->lista_tarjeta_eco2) as $item)
                        @if(!empty(trim($item)))
                        <li class="flex items-start">
                            <svg class="w-4 h-4 text-yellow-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-gray-700">{{ trim($item) }}</span>
                        </li>
                        @endif
                    @endforeach
                @else
                    <li class="flex items-start">
                        <svg class="w-4 h-4 text-yellow-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-gray-700">Participación en eventos premium</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-4 h-4 text-yellow-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-gray-700">Oportunidades de co-marketing</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-4 h-4 text-yellow-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-gray-700">Soporte técnico prioritario</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-4 h-4 text-yellow-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-gray-700">Visibilidad en nuestra web y materiales</span>
                    </li>
                @endif
            </ul>
        </div>
    </div>
    
    <!-- Nivel Silver -->
    <div class="rounded-lg overflow-hidden border border-gray-200 shadow-sm">
        <div class="p-5 bg-gray-50">
            <h3 class="text-xl font-bold text-gray-900 mb-1">
                {{ $partners->titulo_tarjeta_eco3 ?? 'Silver' }}
            </h3>
            <p class="text-gray-600">
                {{ $partners->subtitulo_eco3 ?? 'Colaboración básica' }}
            </p>
        </div>
        <div class="p-5 bg-white">
            <ul class="space-y-3">
                @if(!empty($partners->lista_tarjeta_eco3))
                    @foreach(explode("\n", $partners->lista_tarjeta_eco3) as $item)
                        @if(!empty(trim($item)))
                        <li class="flex items-start">
                            <svg class="w-4 h-4 text-gray-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                            </svg>
                            <span class="text-gray-700">{{ trim($item) }}</span>
                        </li>
                        @endif
                    @endforeach
                @else
                    <li class="flex items-start">
                        <svg class="w-4 h-4 text-gray-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-gray-700">Networking con otros partners</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-4 h-4 text-gray-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-gray-700">Recursos técnicos y de marketing</span>
                    </li>
                    <li class="flex items-start">
                        <svg class="w-4 h-4 text-gray-500 mr-2 mt-0.5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                        <span class="text-gray-700">Acceso a nuestro programa de certificación</span>
                    </li>
                @endif
            </ul>
        </div>
    </div>
</div>

        <!-- Toggle del formulario -->
        <div class="text-center mb-4">
            <button id="toggleFormBtn" class="inline-flex items-center px-5 py-2.5 bg-cyan-500 text-white font-medium rounded-full hover:bg-cyan-600 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                <span>Mostrar formulario</span>
            </button>
        </div>

        <!-- Formulario de solicitud -->
        <div id="partnershipForm" class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-8 border border-gray-200 mt-4" style="display: none;">
            <h3 class="text-xl font-bold text-gray-900 mb-4">Solicitud de partnership</h3>
            
            <form action="{{ route('partnership.submit') }}" method="POST" class="space-y-4">
                @csrf
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <label for="nombre" class="block text-sm font-medium text-gray-700 mb-1">Nombre completo</label>
                        <input type="text" id="nombre" name="nombre" class="text-gray-600 w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500" placeholder="Tu nombre" required>
                    </div>
                    
                    <div>
                        <label for="empresa" class="block text-sm font-medium text-gray-700 mb-1">Empresa</label>
                        <input type="text" id="empresa" name="empresa" class="text-gray-600 w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500" placeholder="Nombre de la empresa" required>
                    </div>
                </div>
                
                <div>
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Correo electrónico</label>
                    <input type="email" id="email" name="email" class="w-full text-gray-600 border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500" placeholder="tu@email.com" required>
                </div>
                
                <div>
                    <label for="nivel" class="block text-sm font-medium text-gray-700 mb-1">Nivel de partnership deseado</label>
                    <select id="nivel" name="nivel" class="w-full border text-gray-600 border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500" required>
                        <option value="">Selecciona una opción</option>
                        <option value="platinum">Platinum</option>
                        <option value="gold" selected>Gold</option>
                        <option value="silver">Silver</option>
                    </select>
                </div>
                
                <div>
                    <label for="mensaje" class="block text-sm font-medium text-gray-700 mb-1">Mensaje</label>
                    <textarea id="mensaje" name="mensaje" rows="4" class="text-gray-600 w-full border border-gray-300 rounded-md py-2 px-3 focus:outline-none focus:ring-2 focus:ring-cyan-500 focus:border-cyan-500" placeholder="Cuéntanos sobre tu empresa y cómo podemos colaborar..."></textarea>
                </div>
                
                <div class="text-right">
                    <button type="submit" class="inline-flex items-center px-5 py-2.5 bg-cyan-500 text-white font-medium rounded-md hover:bg-cyan-600 transition focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-cyan-500">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 19l9 2-9-18-9 18 9-2zm0 0v-8"></path>
                        </svg>
                        Enviar solicitud
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>



<!-- Sección de Contacto Modernizada -->
<section id="contacto" class="contact-section relative">
    <!-- Formas geométricas disruptivas -->
    <div class="shape-disruptor shape-1" style="opacity: 0.1; top: 20%; left: 10%;"></div>
    <div class="shape-disruptor shape-2" style="opacity: 0.1; bottom: 10%; right: 10%;"></div>

    <div class="container mx-auto px-4">
        <span class="contact-tag scroll-reveal">{{ $content->contact_tag }}</span>
        <h2 class="contact-title scroll-reveal">{{ $content->contact_title }}</h2>
        <p class="contact-description scroll-reveal delay-1">
            {{ $content->contact_description }}
        </p>

        <div class="contact-form scroll-reveal zoom-in delay-2">
            <div class="contact-form-info">
                <h3 class="contact-info-title">Información de contacto</h3>

                <!-- Información de contacto en la parte superior -->
                <div class="contact-info-group">
                    <div class="contact-info-item">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                        </svg>
                        <span class="contact-info-text">{{ $content->contact_phone }}</span>
                    </div>

                    <div class="contact-info-item">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                            <polyline points="22,6 12,13 2,6"></polyline>
                        </svg>
                        <span class="contact-info-text">{{ $content->contact_email }}</span>
                    </div>

                    <div class="contact-info-item">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                            <circle cx="12" cy="10" r="3"></circle>
                        </svg>
                        <span class="contact-info-text">{{ $content->contact_address }}</span>
                    </div>
                </div>

                 <!-- Horario -->
<div class="contact-info-item flex items-start">
    <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 mr-4">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#00b8c4]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <path d="M12 8v4l3 3"></path>
            <circle cx="12" cy="12" r="10"></circle>
        </svg>
    </div>
    <div>
        <span class="contact-info-text text-white/90">
            Lunes a Viernes<br />
            9:00 - 18:00
        </span>
    </div>
</div>

                <!-- Espacio flexible para empujar las redes sociales hacia abajo -->
                <div class="flex-spacer" style="flex-grow: 1; min-height: 40px;"></div>

                <!-- Redes sociales en la parte inferior -->
                <div class="contact-social">
                    <h4 class="contact-social-title">Síguenos en redes sociales</h4>
                    <div class="social-icons">
                        <a href="#" class="social-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                            </svg>
                        </a>
                        <a href="#" class="social-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                            </svg>
                        </a>
                        <a href="#" class="social-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                                <rect x="2" y="9" width="4" height="12"></rect>
                                <circle cx="4" cy="4" r="2"></circle>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>

            <div class="contact-form-fields">
                <form action="{{ route('cotizacion.enviar') }}" method="POST" id="cotizacionForm" class="cotizacion-form">
                    @csrf
                    <input type="hidden" name="formulario" value="solicitud_cotizacion">
                    
                    @if(session('success'))
                    <div class="mensaje-exito">
                        {{ session('success') }}
                    </div>
                    @endif
                    
                    @if($errors->any())
                    <div class="mensaje-error">
                        <ul>
                            @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif
                    
                    <div class="form-row">
                    <div class="input-group">
                            <label for="name" class="input-label">Nombre de la empresa</label>
                            <input type="text" id="name" name="nombre" class="input-field" value="{{ old('nombre') }}" placeholder="Nombre de la empresa" required>
                        </div>
                        <div class="input-group">
                            <label for="name" class="input-label">Nombre</label>
                            <input type="text" id="name" name="nombre" class="input-field" value="{{ old('nombre') }}" placeholder="Tu nombre completo" required>
                        </div>

                     

                        <div class="input-group">
                            <label for="email" class="input-label">Correo electrónico</label>
                            <input type="email" id="email" name="email" class="input-field" value="{{ old('email') }}" placeholder="ejemplo@email.com" required>
                        </div>
                    </div>

                    <div class="form-row">
                        <div class="input-group">
                            <label for="phone" class="input-label">Teléfono (opcional)</label>
                            <input type="tel" id="phone" name="telefono" class="input-field" value="{{ old('telefono') }}" placeholder="+34 600 000 000">
                        </div>

                        <div class="input-group">
                            <label for="servicio" class="input-label">Servicio que necesitas</label>
                            <select id="servicio" name="servicio" class="input-fieldse" required>
                                <option value="" disabled {{ old('servicio') ? '' : 'selected' }}>Selecciona un servicio</option>
                                <option value="Desarrollo Web" {{ old('servicio') == 'Desarrollo Web' ? 'selected' : '' }}>Desarrollo Web</option>
                                <option value="Desarrollo Móvil" {{ old('servicio') == 'Desarrollo Móvil' ? 'selected' : '' }}>Desarrollo Móvil</option>
                                <option value="DevOps" {{ old('servicio') == 'Desarrollo Móvil' ? 'selected' : '' }}>DevOps</option>
                                <option value="Servicios Cloud" {{ old('servicio') == 'Servicios Cloud' ? 'selected' : '' }}>Servicios Cloud</option>
                                <option value="Consultoría Tecnológica" {{ old('servicio') == 'Consultoría Tecnológica' ? 'selected' : '' }}>Conectividad</option>
                                <option value="Diseño UX/UI" {{ old('servicio') == 'Diseño UX/UI' ? 'selected' : '' }}>Ciberseguridad</option>
                                <option value="Otro" {{ old('servicio') == 'Otro' ? 'selected' : '' }}>Otro</option>
                            </select>
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="region" class="input-label">Región</label>
                        <select id="region" name="region" class="input-fieldse" required>
                            <option value="" disabled {{ old('region') ? '' : 'selected' }}>Selecciona una región</option>
                            <option value="Madrid" {{ old('region') == 'Madrid' ? 'selected' : '' }}>Madrid</option>
                            <option value="Barcelona" {{ old('region') == 'Barcelona' ? 'selected' : '' }}>Barcelona</option>
                            <option value="Valencia" {{ old('region') == 'Valencia' ? 'selected' : '' }}>Valencia</option>
                            <option value="Sevilla" {{ old('region') == 'Sevilla' ? 'selected' : '' }}>Sevilla</option>
                            <option value="Bilbao" {{ old('region') == 'Bilbao' ? 'selected' : '' }}>Bilbao</option>
                            <option value="Otra" {{ old('region') == 'Otra' ? 'selected' : '' }}>Otra</option>
                        </select>
                    </div>

                    <div class="input-group">
                        <label for="presupuesto" class="input-label">Rango de presupuesto</label>
                        <select id="presupuesto" name="presupuesto" class="input-fieldse" required>
                            <option value="" disabled {{ old('presupuesto') ? '' : 'selected' }}>Selecciona un rango</option>
                            <option value="Menos de 5.000 €" {{ old('presupuesto') == 'Menos de 5.000 €' ? 'selected' : '' }}>Menos de 5.000 €</option>
                            <option value="5.000 € - 10.000 €" {{ old('presupuesto') == '5.000 € - 10.000 €' ? 'selected' : '' }}>5.000 € - 10.000 €</option>
                            <option value="10.000 € - 20.000 €" {{ old('presupuesto') == '10.000 € - 20.000 €' ? 'selected' : '' }}>10.000 € - 20.000 €</option>
                            <option value="20.000 € - 50.000 €" {{ old('presupuesto') == '20.000 € - 50.000 €' ? 'selected' : '' }}>20.000 € - 50.000 €</option>
                            <option value="Más de 50.000 €" {{ old('presupuesto') == 'Más de 50.000 €' ? 'selected' : '' }}>Más de 50.000 €</option>
                        </select>
                    </div>

                    <div class="input-group">
                        <label for="message" class="input-label">Mensaje</label>
                        <textarea id="message" name="mensaje" class="input-field" placeholder="Cuéntanos sobre tu proyecto o consulta" required>{{ old('mensaje') }}</textarea>
                    </div>

                    <div class="form-legal">
                        <input type="checkbox" id="privacidad" name="acepto_privacidad" required {{ old('acepto_privacidad') ? 'checked' : '' }}>
                        <label for="privacidad" class="legal-label">He leído y acepto las condiciones de uso y la política de privacidad</label>
                    </div>

                    <button type="submit" class="submit-button">
                        Solicitar cotización
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </button>
                </form>
            </div>
        </div>
    </div>

	
</section>


@endsection
