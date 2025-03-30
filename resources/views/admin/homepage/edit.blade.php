@extends('layouts.admin')

@section('title', 'DevCloud Partners - Editar Página de Inicio')

@section('content')

<!-- Header del Dashboard -->
<div class="py-6 bg-gradient-to-r from-gray-900 to-black border-b border-gray-800">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-[#c9fcfe] leading-tight">Editar Página de Inicio</h2>
        <p class="mt-2 text-gray-400">Personaliza el contenido mostrado en la página principal</p>
    </div>
</div>

@if(session('success'))
<div class="py-3 max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-green-900 bg-opacity-20 border border-green-800 text-green-300 px-4 py-3 rounded-lg">
        <span class="inline-block align-middle mr-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </span>
        {{ session('success') }}
    </div>
</div>
@endif

@if($errors->any())
<div class="py-3 max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-red-900 bg-opacity-20 border border-red-800 text-red-300 px-4 py-3 rounded-lg">
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif

<form action="{{ route('admin.homepage.update') }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method('PUT')

    <!-- Sección Hero -->
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#0a0a0a] border border-gray-800 rounded-lg overflow-hidden shadow-lg">
                <div class="border-b border-gray-800 px-6 py-4 bg-gray-900 flex justify-between items-center">
                    <h3 class="text-lg font-medium text-[#c9fcfe]">
                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path>
                        </svg>
                        Sección Hero
                    </h3>
                    <button type="button" class="text-gray-500 hover:text-[#c9fcfe]" onclick="toggleSection('heroSection')">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                </div>
                
                <div id="heroSection" class="p-6">
                    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                        <div>
                            <div class="mb-4">
                                <label for="hero_tagline" class="block text-sm font-medium text-gray-400 mb-1">Tagline</label>
                                <input type="text" id="hero_tagline" name="hero_tagline" class="w-full bg-gray-900 border border-gray-700 rounded-md py-2 px-3 text-[#c9fcfe] focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('hero_tagline', $content->hero_tagline) }}" >
                            </div>
                            
                            <div class="mb-4">
                                <label for="hero_title_1" class="block text-sm font-medium text-gray-400 mb-1">Título (Parte 1)</label>
                                <input type="text" id="hero_title_1" name="hero_title_1" class="w-full bg-gray-900 border border-gray-700 rounded-md py-2 px-3 text-[#c9fcfe] focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('hero_title_1', $content->hero_title_1) }}" >
                                <small class="text-gray-500">Será mostrado como: "Transformamos <span class="text-[#c9fcfe]">empresas</span>"</small>
                            </div>
                            
                            <div class="mb-4">
                                <label for="hero_title_2" class="block text-sm font-medium text-gray-400 mb-1">Título (Parte 2)</label>
                                <input type="text" id="hero_title_2" name="hero_title_2" class="w-full bg-gray-900 border border-gray-700 rounded-md py-2 px-3 text-[#c9fcfe] focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('hero_title_2', $content->hero_title_2) }}" >
                                <small class="text-gray-500">Será mostrado como: "a través de la <span class="text-[#c9fcfe]">tecnología</span>"</small>
                            </div>
                        </div>
                        
                        <div>
                            <div class="mb-4">
                                <label for="hero_description" class="block text-sm font-medium text-gray-400 mb-1">Descripción</label>
                                <textarea id="hero_description" name="hero_description" rows="3" class="w-full bg-gray-900 border border-gray-700 rounded-md py-2 px-3 text-[#c9fcfe] focus:outline-none focus:ring-2 focus:ring-blue-500" >{{ old('hero_description', $content->hero_description) }}</textarea>
                            </div>
                            
                            <div class="mb-4">
                                <label for="hero_bg_image" class="block text-sm font-medium text-gray-400 mb-1">Imagen de fondo</label>
                                <div class="flex items-center">
                                    <input type="text" class="flex-grow bg-gray-900 border border-gray-700 rounded-l-md py-2 px-3 text-[#c9fcfe] focus:outline-none focus:ring-blue-500" value="{{ $content->hero_bg_image ? $content->hero_bg_image : '/images/cloud-dark-bg.jpg' }}" readonly>
                                    <label for="hero_bg_image" class="cursor-pointer bg-gray-800 text-gray-300 px-4 py-2 rounded-r-md hover:bg-gray-700 transition">
                                        Explorar
                                        <input type="file" id="hero_bg_image" name="hero_bg_image" class="hidden">
                                    </label>
                                </div>
                                <small class="text-gray-500">Imagen recomendada: 1920x1080px. JPG o PNG.</small>
                                
                                @if($content->hero_bg_image)
                                <div class="mt-2">
                                    <img src="{{ $content->hero_bg_image_url }}" alt="Hero background" class="h-24 object-cover rounded border border-gray-700">
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Estadísticas -->
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#0a0a0a] border border-gray-800 rounded-lg overflow-hidden shadow-lg">
                <div class="border-b border-gray-800 px-6 py-4 bg-gray-900 flex justify-between items-center">
                    <h3 class="text-lg font-medium text-[#c9fcfe]">
                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                        Estadísticas
                    </h3>
                    <button type="button" class="text-gray-500 hover:text-[#c9fcfe]" onclick="toggleSection('statsSection')">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                </div>
                
                <div id="statsSection" class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                        <div>
                            <label for="stat_projects" class="block text-sm font-medium text-gray-400 mb-1">Proyectos completados</label>
                            <input type="text" id="stat_projects" name="stat_projects" class="w-full bg-gray-900 border border-gray-700 rounded-md py-2 px-3 text-[#c9fcfe] focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('stat_projects', $content->stat_projects) }}" >
                            <small class="text-gray-500">Ejemplo: 200+</small>
                        </div>
                        
                        <div>
                            <label for="stat_clients" class="block text-sm font-medium text-gray-400 mb-1">Clientes satisfechos</label>
                            <input type="text" id="stat_clients" name="stat_clients" class="w-full bg-gray-900 border border-gray-700 rounded-md py-2 px-3 text-[#c9fcfe] focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('stat_clients', $content->stat_clients) }}" >
                            <small class="text-gray-500">Ejemplo: 98%</small>
                        </div>
                        
                        <div>
                            <label for="stat_experts" class="block text-sm font-medium text-gray-400 mb-1">Expertos certificados</label>
                            <input type="text" id="stat_experts" name="stat_experts" class="w-full bg-gray-900 border border-gray-700 rounded-md py-2 px-3 text-[#c9fcfe] focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('stat_experts', $content->stat_experts) }}" >
                            <small class="text-gray-500">Ejemplo: 50+</small>
                        </div>
                        
                        <div>
                            <label for="stat_years" class="block text-sm font-medium text-gray-400 mb-1">Años de experiencia</label>
                            <input type="text" id="stat_years" name="stat_years" class="w-full bg-gray-900 border border-gray-700 rounded-md py-2 px-3 text-[#c9fcfe] focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('stat_years', $content->stat_years) }}" >
                            <small class="text-gray-500">Ejemplo: 15+</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
<!-- Sección Servicios -->
<div class="py-3">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-[#0a0a0a] border border-gray-800 rounded-lg overflow-hidden shadow-lg">
            <div class="border-b border-gray-800 px-6 py-4 bg-gray-900 flex justify-between items-center">
                <h3 class="text-lg font-medium text-[#c9fcfe]">
                    <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                    </svg>
                    Sección Servicios
                </h3>
                <button type="button" class="text-gray-500 hover:text-[#c9fcfe]" onclick="toggleSection('servicesSection')">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
            </div>
            
            <div id="servicesSection" class="p-6">
                <div class="mb-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="services_tag" class="block text-sm font-medium text-gray-400 mb-1">Tag de servicios</label>
                            <input type="text" id="services_tag" name="services_tag" class="w-full bg-gray-900 border border-gray-700 rounded-md py-2 px-3 text-[#c9fcfe] focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('services_tag', $content->services_tag) }}" >
                        </div>
                        
                        <div>
                            <label for="services_title" class="block text-sm font-medium text-gray-400 mb-1">Título de servicios</label>
                            <input type="text" id="services_title" name="services_title" class="w-full bg-gray-900 border border-gray-700 rounded-md py-2 px-3 text-[#c9fcfe] focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('services_title', $content->services_title) }}" >
                        </div>
                        
                        <div>
                            <label for="services_description" class="block text-sm font-medium text-gray-400 mb-1">Descripción</label>
                            <textarea id="services_description" name="services_description" rows="2" class="w-full bg-gray-900 border border-gray-700 rounded-md py-2 px-3 text-[#c9fcfe] focus:outline-none focus:ring-2 focus:ring-blue-500" >{{ old('services_description', $content->services_description) }}</textarea>
                        </div>
                    </div>
                </div>
                
                <div class="flex justify-between items-center mb-4">
                    <h4 class="text-md font-medium text-[#c9fcfe]">Servicios individuales</h4>
                    <button type="button" id="addServiceBtn" class="flex items-center px-3 py-2 bg-blue-900 text-[#c9fcfe] rounded hover:bg-blue-800 transition">
                        <svg class="w-4 h-4 mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Agregar servicio
                    </button>
                </div>
                
                <div id="services-container">
                    @if(isset($content->services) && is_array($content->services) && count($content->services) > 0)
                        @foreach($content->services as $index => $service)
                            <div class="service-item bg-gray-900 border border-gray-800 rounded-lg p-4 mb-4" data-index="{{ $index }}">
                                <div class="flex justify-between items-start mb-3">
                                    <h5 class="text-[#c9fcfe] font-medium service-title-display">
                                        Servicio: {{ $service['title'] ?? 'Nuevo servicio' }}
                                    </h5>
                                    <div class="flex space-x-2">
                                        <button type="button" class="move-service-up text-gray-500 hover:text-gray-300" title="Mover arriba">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                                            </svg>
                                        </button>
                                        <button type="button" class="move-service-down text-gray-500 hover:text-gray-300" title="Mover abajo">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>
                                        <button type="button" class="toggle-service text-gray-500 hover:text-gray-300" title="Expandir/Colapsar">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                            </svg>
                                        </button>
                                        <button type="button" class="delete-service text-red-500 hover:text-red-400" title="Eliminar">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                                
                                <div class="service-details grid grid-cols-1 md:grid-cols-3 gap-4">
                                    <div>
                                        <label for="service_title_{{ $index }}" class="block text-sm font-medium text-gray-400 mb-1">Título</label>
                                        <input type="text" id="service_title_{{ $index }}" name="services[{{ $index }}][title]" class="service-title w-full bg-gray-900 border border-gray-700 rounded-md py-2 px-3 text-[#c9fcfe] focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old("services.$index.title", $service['title'] ?? '') }}" >
                                    </div>
                                    
                                    <div>
                                        <label for="service_description_{{ $index }}" class="block text-sm font-medium text-gray-400 mb-1">Descripción</label>
                                        <textarea id="service_description_{{ $index }}" name="services[{{ $index }}][description]" rows="2" class="w-full bg-gray-900 border border-gray-700 rounded-md py-2 px-3 text-[#c9fcfe] focus:outline-none focus:ring-2 focus:ring-blue-500" >{{ old("services.$index.description", $service['description'] ?? '') }}</textarea>
                                    </div>
                                    
                                    <div>
                                        <label for="service_icon_{{ $index }}" class="block text-sm font-medium text-gray-400 mb-1">Icono</label>
                                        <div class="flex items-center">
                                            <input type="text" class="flex-grow bg-gray-900 border border-gray-700 rounded-l-md py-2 px-3 text-[#c9fcfe] focus:outline-none focus:ring-blue-500" value="{{ isset($service['icon']) ? $service['icon'] : 'Ninguno seleccionado' }}" readonly>
                                            <label for="service_icon_{{ $index }}" class="cursor-pointer bg-gray-800 text-gray-300 px-4 py-2 rounded-r-md hover:bg-gray-700 transition">
                                                Explorar
                                                <input type="file" id="service_icon_{{ $index }}" name="services[{{ $index }}][icon]" class="hidden service-icon-input">
                                            </label>
                                        </div>
                                        <small class="text-gray-500">Icono recomendado: PNG, SVG, 64x64px.</small>
                                        
                                        @if(isset($service['icon']) && $service['icon'])
                                        <div class="mt-2 icon-preview">
                                            <img src="{{ isset($service['icon']) ? asset($service['icon']) : '' }}" alt="Icono de servicio" class="h-10 rounded border border-gray-700">
                                        </div>
                                        @else
                                        <div class="mt-2 icon-preview" style="display: none;"></div>
                                        @endif
                                        
                                        <!-- Campo oculto para mantener el icono existente si no se sube uno nuevo -->
                                        <input type="hidden" name="services[{{ $index }}][existing_icon]" value="{{ $service['icon'] ?? '' }}">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @else
                        <!-- Plantilla de servicio inicial si no hay servicios -->
                        <div class="service-item bg-gray-900 border border-gray-800 rounded-lg p-4 mb-4" data-index="0">
                            <div class="flex justify-between items-start mb-3">
                                <h5 class="text-[#c9fcfe] font-medium service-title-display">Nuevo servicio</h5>
                                <div class="flex space-x-2">
                                    <button type="button" class="move-service-up text-gray-500 hover:text-gray-300" title="Mover arriba">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                                        </svg>
                                    </button>
                                    <button type="button" class="move-service-down text-gray-500 hover:text-gray-300" title="Mover abajo">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </button>
                                    <button type="button" class="toggle-service text-gray-500 hover:text-gray-300" title="Expandir/Colapsar">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                                        </svg>
                                    </button>
                                    <button type="button" class="delete-service text-red-500 hover:text-red-400" title="Eliminar">
                                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                        </svg>
                                    </button>
                                </div>
                            </div>
                            
                            <div class="service-details grid grid-cols-1 md:grid-cols-3 gap-4">
                                <div>
                                    <label for="service_title_0" class="block text-sm font-medium text-gray-400 mb-1">Título</label>
                                    <input type="text" id="service_title_0" name="services[0][title]" class="service-title w-full bg-gray-900 border border-gray-700 rounded-md py-2 px-3 text-[#c9fcfe] focus:outline-none focus:ring-2 focus:ring-blue-500" value="" >
                                </div>
                                
                                <div>
                                    <label for="service_description_0" class="block text-sm font-medium text-gray-400 mb-1">Descripción</label>
                                    <textarea id="service_description_0" name="services[0][description]" rows="2" class="w-full bg-gray-900 border border-gray-700 rounded-md py-2 px-3 text-[#c9fcfe] focus:outline-none focus:ring-2 focus:ring-blue-500" ></textarea>
                                </div>
                                
                                <div>
                                    <label for="service_icon_0" class="block text-sm font-medium text-gray-400 mb-1">Icono</label>
                                    <div class="flex items-center">
                                        <input type="text" class="flex-grow bg-gray-900 border border-gray-700 rounded-l-md py-2 px-3 text-[#c9fcfe] focus:outline-none focus:ring-blue-500" value="Ninguno seleccionado" readonly>
                                        <label for="service_icon_0" class="cursor-pointer bg-gray-800 text-gray-300 px-4 py-2 rounded-r-md hover:bg-gray-700 transition">
                                            Explorar
                                            <input type="file" id="service_icon_0" name="services[0][icon]" class="hidden service-icon-input">
                                        </label>
                                    </div>
                                    <small class="text-gray-500">Icono recomendado: PNG, SVG, 64x64px.</small>
                                    <div class="mt-2 icon-preview" style="display: none;"></div>
                                    <input type="hidden" name="services[0][existing_icon]" value="">
                                </div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Template oculto para nuevos servicios -->
<template id="service-template">
    <div class="service-item bg-gray-900 border border-gray-800 rounded-lg p-4 mb-4" data-index="__INDEX__">
        <div class="flex justify-between items-start mb-3">
            <h5 class="text-[#c9fcfe] font-medium service-title-display">Nuevo servicio</h5>
            <div class="flex space-x-2">
                <button type="button" class="move-service-up text-gray-500 hover:text-gray-300" title="Mover arriba">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 15l7-7 7 7"></path>
                    </svg>
                </button>
                <button type="button" class="move-service-down text-gray-500 hover:text-gray-300" title="Mover abajo">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <button type="button" class="toggle-service text-gray-500 hover:text-gray-300" title="Expandir/Colapsar">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                    </svg>
                </button>
                <button type="button" class="delete-service text-red-500 hover:text-red-400" title="Eliminar">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <div class="service-details grid grid-cols-1 md:grid-cols-3 gap-4">
            <div>
                <label for="service_title___INDEX__" class="block text-sm font-medium text-gray-400 mb-1">Título</label>
                <input type="text" id="service_title___INDEX__" name="services[__INDEX__][title]" class="service-title w-full bg-gray-900 border border-gray-700 rounded-md py-2 px-3 text-[#c9fcfe] focus:outline-none focus:ring-2 focus:ring-blue-500" value="" >
            </div>
            
            <div>
                <label for="service_description___INDEX__" class="block text-sm font-medium text-gray-400 mb-1">Descripción</label>
                <textarea id="service_description___INDEX__" name="services[__INDEX__][description]" rows="2" class="w-full bg-gray-900 border border-gray-700 rounded-md py-2 px-3 text-[#c9fcfe] focus:outline-none focus:ring-2 focus:ring-blue-500" ></textarea>
            </div>
            
            <div>
                <label for="service_icon___INDEX__" class="block text-sm font-medium text-gray-400 mb-1">Icono</label>
                <div class="flex items-center">
                    <input type="text" class="flex-grow bg-gray-900 border border-gray-700 rounded-l-md py-2 px-3 text-[#c9fcfe] focus:outline-none focus:ring-blue-500" value="Ninguno seleccionado" readonly>
                    <label for="service_icon___INDEX__" class="cursor-pointer bg-gray-800 text-gray-300 px-4 py-2 rounded-r-md hover:bg-gray-700 transition">
                        Explorar
                        <input type="file" id="service_icon___INDEX__" name="services[__INDEX__][icon]" class="hidden service-icon-input">
                    </label>
                </div>
                <small class="text-gray-500">Icono recomendado: PNG, SVG, 64x64px.</small>
                <div class="mt-2 icon-preview" style="display: none;"></div>
                <input type="hidden" name="services[__INDEX__][existing_icon]" value="">
            </div>
        </div>
    </div>
</template>
    
    <!-- Sección Contacto -->
    <div class="py-3">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#0a0a0a] border border-gray-800 rounded-lg overflow-hidden shadow-lg">
                <div class="border-b border-gray-800 px-6 py-4 bg-gray-900 flex justify-between items-center">
                    <h3 class="text-lg font-medium text-[#c9fcfe]">
                        <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"></path>
                        </svg>
                        Sección Contacto
                    </h3>
                    <button type="button" class="text-gray-500 hover:text-[#c9fcfe]" onclick="toggleSection('contactSection')">
                        <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7"></path>
                        </svg>
                    </button>
                </div>
                
                <div id="contactSection" class="p-6">
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
                        <div>
                            <label for="contact_tag" class="block text-sm font-medium text-gray-400 mb-1">Tag de contacto</label>
                            <input type="text" id="contact_tag" name="contact_tag" class="w-full bg-gray-900 border border-gray-700 rounded-md py-2 px-3 text-[#c9fcfe] focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('contact_tag', $content->contact_tag) }}" >
                        </div>
                        
                        <div>
                            <label for="contact_title" class="block text-sm font-medium text-gray-400 mb-1">Título de contacto</label>
                            <input type="text" id="contact_title" name="contact_title" class="w-full bg-gray-900 border border-gray-700 rounded-md py-2 px-3 text-[#c9fcfe] focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('contact_title', $content->contact_title) }}" >
                        </div>
                        
                        <div>
                            <label for="contact_description" class="block text-sm font-medium text-gray-400 mb-1">Descripción</label>
                            <textarea id="contact_description" name="contact_description" rows="2" class="w-full bg-gray-900 border border-gray-700 rounded-md py-2 px-3 text-[#c9fcfe] focus:outline-none focus:ring-2 focus:ring-blue-500" >{{ old('contact_description', $content->contact_description) }}</textarea>
                        </div>
                    </div>
                    
                    <h4 class="text-md font-medium text-[#c9fcfe] mb-4">Información de contacto</h4>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <div>
                            <label for="contact_phone" class="block text-sm font-medium text-gray-400 mb-1">Teléfono</label>
                            <input type="text" id="contact_phone" name="contact_phone" class="w-full bg-gray-900 border border-gray-700 rounded-md py-2 px-3 text-[#c9fcfe] focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('contact_phone', $content->contact_phone) }}" >
                        </div>
                        
                        <div>
                            <label for="contact_email" class="block text-sm font-medium text-gray-400 mb-1">Correo electrónico</label>
                            <input type="email" id="contact_email" name="contact_email" class="w-full bg-gray-900 border border-gray-700 rounded-md py-2 px-3 text-[#c9fcfe] focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('contact_email', $content->contact_email) }}" >
                        </div>
                        
                        <div>
                            <label for="contact_address" class="block text-sm font-medium text-gray-400 mb-1">Dirección</label>
                            <input type="text" id="contact_address" name="contact_address" class="w-full bg-gray-900 border border-gray-700 rounded-md py-2 px-3 text-[#c9fcfe] focus:outline-none focus:ring-2 focus:ring-blue-500" value="{{ old('contact_address', $content->contact_address) }}" >
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Botones de acción -->
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-end space-x-4">
                <a href="{{ route('dashboard') }}" class="px-6 py-3 bg-gray-800 text-gray-300 rounded-md hover:bg-gray-700 transition">
                    Cancelar
                </a>
                <button type="submit" class="px-6 py-3 bg-blue-900 text-[#c9fcfe] rounded-md hover:bg-blue-800 transition">
                    Guardar cambios
                </button>
            </div>
        </div>
    </div>
</form>

@endsection

@push('scripts')
@endpush
