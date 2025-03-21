@extends('layouts.admin')

@section('title', 'DevCloud Partners - Dashboard')

@section('content')

<!-- Header del Dashboard -->
<div class="py-6 bg-gradient-to-r from-gray-900 to-black border-b border-gray-800">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-[#c9fcfe] leading-tight">Dashboard</h2>
        <p class="mt-2 text-gray-400">Administra y visualiza las estadísticas de tu negocio</p>
    </div>
</div>

<!-- Mensaje de bienvenida -->
<div class="py-6">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-[#0a0a0a] border border-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
            <div class="p-6 text-[#c9fcfe] flex justify-between items-center">
                <div>
                    <h3 class="text-lg font-medium">¡Bienvenido al panel de administración!</h3>
                    <p class="text-gray-400 mt-1">Desde aquí podrás gestionar toda la información mostrada en tu sitio web.</p>
                </div>
                <button class="px-4 py-2 bg-blue-900 text-[#c9fcfe] rounded-md hover:bg-blue-800 transition">
                    <svg class="w-5 h-5 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Nuevo proyecto
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Tarjetas de estadísticas -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
    <h3 class="text-xl font-semibold text-[#c9fcfe] mb-4">Estadísticas Generales</h3>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <!-- Tarjeta de Usuarios -->
        <div class="bg-[#0a0a0a] border border-gray-800 rounded-lg p-6 shadow">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-900 bg-opacity-25">
                    <svg class="w-8 h-8 text-[#c9fcfe]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                    </svg>
                </div>
                <div class="ml-4 flex-grow">
                    <p class="text-gray-400 text-sm">Usuarios</p>
                    <p class="text-2xl font-semibold text-[#c9fcfe]">2,789</p>
                </div>
                <button class="text-gray-500 hover:text-[#c9fcfe]" title="Editar">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- Tarjeta de Proyectos -->
        <div class="bg-[#0a0a0a] border border-gray-800 rounded-lg p-6 shadow">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-900 bg-opacity-25">
                    <svg class="w-8 h-8 text-[#c9fcfe]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                    </svg>
                </div>
                <div class="ml-4 flex-grow">
                    <p class="text-gray-400 text-sm">Proyectos</p>
                    <p class="text-2xl font-semibold text-[#c9fcfe]">142</p>
                </div>
                <button class="text-gray-500 hover:text-[#c9fcfe]" title="Editar">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                    </svg>
                </button>
            </div>
        </div>
        
        <!-- Otras tarjetas... -->
    </div>
</div>

<!-- Sección de Hero editable (simplificada) -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
    <div class="bg-[#0a0a0a] border border-gray-800 rounded-lg overflow-hidden shadow-lg">
        <div class="border-b border-gray-800 px-6 py-4 bg-gray-900 flex justify-between items-center">
            <h3 class="text-lg font-medium text-[#c9fcfe]">
                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path>
                </svg>
                Sección Hero
            </h3>
            <div>
                <button class="px-3 py-1 text-sm bg-blue-900 text-[#c9fcfe] rounded hover:bg-blue-800 transition mr-2">
                    Guardar cambios
                </button>
                <button class="px-3 py-1 text-sm bg-gray-800 text-gray-300 rounded hover:bg-gray-700 transition">
                    Vista previa
                </button>
            </div>
        </div>
        
        <div class="p-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <div class="mb-4">
                        <label for="hero_tagline" class="block text-sm font-medium text-gray-400 mb-1">Tagline</label>
                        <input type="text" id="hero_tagline" class="w-full bg-gray-900 border border-gray-700 rounded-md py-2 px-3 text-[#c9fcfe] focus:outline-none focus:ring-2 focus:ring-blue-500" value="Consultoría tecnológica especializada">
                    </div>
                    
                    <div class="mb-4">
                        <label for="hero_title" class="block text-sm font-medium text-gray-400 mb-1">Título principal</label>
                        <input type="text" id="hero_title" class="w-full bg-gray-900 border border-gray-700 rounded-md py-2 px-3 text-[#c9fcfe] focus:outline-none focus:ring-2 focus:ring-blue-500" value="Transformamos empresas a través de la tecnología">
                    </div>
                    
                    <div class="mb-4">
                        <label for="hero_description" class="block text-sm font-medium text-gray-400 mb-1">Descripción</label>
                        <textarea id="hero_description" rows="3" class="w-full bg-gray-900 border border-gray-700 rounded-md py-2 px-3 text-[#c9fcfe] focus:outline-none focus:ring-2 focus:ring-blue-500">Soluciones innovadoras en Cloud Computing, DevOps y Telecomunicaciones para impulsar la transformación digital de tu negocio.</textarea>
                    </div>
                </div>
                
                <div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-400 mb-1">Imagen de fondo</label>
                        <div class="flex items-center">
                            <input type="text" class="flex-grow bg-gray-900 border border-gray-700 rounded-l-md py-2 px-3 text-[#c9fcfe] focus:outline-none focus:ring-2 focus:ring-blue-500" value="/images/cloud-dark-bg.jpg">
                            <button class="bg-gray-800 text-gray-300 px-4 py-2 rounded-r-md hover:bg-gray-700 transition">Explorar</button>
                        </div>
                    </div>
                    
                    <!-- Campos para estadísticas... -->
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Servicios Editables (simplificado) -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
    <div class="bg-[#0a0a0a] border border-gray-800 rounded-lg overflow-hidden shadow-lg">
        <div class="border-b border-gray-800 px-6 py-4 bg-gray-900 flex justify-between items-center">
            <h3 class="text-lg font-medium text-[#c9fcfe]">
                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                </svg>
                Servicios
            </h3>
            <div>
                <button class="px-3 py-1 text-sm bg-green-800 text-[#c9fcfe] rounded hover:bg-green-700 transition mr-2">
                    <svg class="w-4 h-4 inline-block mr-1" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                    Añadir servicio
                </button>
                <button class="px-3 py-1 text-sm bg-blue-900 text-[#c9fcfe] rounded hover:bg-blue-800 transition mr-2">
                    Guardar
                </button>
            </div>
        </div>
        
        <div class="p-6">
            <!-- Contenido simplificado de servicios -->
            <div class="mb-6">
                <label for="services_title" class="block text-sm font-medium text-gray-400 mb-1">Título de sección</label>
                <input type="text" id="services_title" class="w-full bg-gray-900 border border-gray-700 rounded-md py-2 px-3 text-[#c9fcfe] focus:outline-none focus:ring-2 focus:ring-blue-500" value="Soluciones tecnológicas para tu negocio">
            </div>
            
            <div class="mb-6">
                <label for="services_description" class="block text-sm font-medium text-gray-400 mb-1">Descripción de sección</label>
                <textarea id="services_description" rows="2" class="w-full bg-gray-900 border border-gray-700 rounded-md py-2 px-3 text-[#c9fcfe] focus:outline-none focus:ring-2 focus:ring-blue-500">Ofrecemos servicios integrales de consultoría y desarrollo tecnológico para potenciar la transformación digital de tu empresa.</textarea>
            </div>
            
            <!-- Lista de servicios (simplificada) -->
            <div class="space-y-4">
                <div class="bg-gray-900 border border-gray-800 rounded-lg p-4">
                    <div class="flex justify-between items-start mb-3">
                        <h4 class="text-[#c9fcfe] font-medium">Cloud Computing</h4>
                        <div class="flex space-x-2">
                            <button class="text-gray-500 hover:text-[#c9fcfe]" title="Editar">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                </svg>
                            </button>
                            <button class="text-gray-500 hover:text-red-500" title="Eliminar">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <p class="text-gray-400">Soluciones en la nube personalizadas para optimizar tus recursos y mejorar la escalabilidad.</p>
                </div>
                
                <div class="bg-gray-900 border border-gray-800 rounded-lg p-4">
                    <div class="flex justify-between items-start mb-3">
                        <h4 class="text-[#c9fcfe] font-medium">DevOps</h4>
                        <div class="flex space-x-2">
                            <button class="text-gray-500 hover:text-[#c9fcfe]" title="Editar">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                                </svg>
                            </button>
                            <button class="text-gray-500 hover:text-red-500" title="Eliminar">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                            </button>
                        </div>
                    </div>
                    <p class="text-gray-400">Automatización y optimización del ciclo de desarrollo, integración y despliegue de software.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Configuración general (simplificada) -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
    <div class="bg-[#0a0a0a] border border-gray-800 rounded-lg overflow-hidden shadow-lg">
        <div class="border-b border-gray-800 px-6 py-4 bg-gray-900 flex justify-between items-center">
            <h3 class="text-lg font-medium text-[#c9fcfe]">
                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"></path>
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"></path>
                </svg>
                Configuración general
            </h3>
            <div>
                <button class="px-3 py-1 text-sm bg-blue-900 text-[#c9fcfe] rounded hover:bg-blue-800 transition mr-2">
                    Guardar cambios
                </button>
            </div>
        </div>
        
        <div class="p-6">
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
                <div>
                    <div class="mb-4">
                        <label for="site_name" class="block text-sm font-medium text-gray-400 mb-1">Nombre del sitio</label>
                        <input type="text" id="site_name" class="w-full bg-gray-900 border border-gray-700 rounded-md py-2 px-3 text-[#c9fcfe] focus:outline-none focus:ring-2 focus:ring-blue-500" value="DevCloud Partners">
                    </div>
                    
                    <div class="mb-4">
                        <label for="site_tagline" class="block text-sm font-medium text-gray-400 mb-1">Eslogan</label>
                        <input type="text" id="site_tagline" class="w-full bg-gray-900 border border-gray-700 rounded-md py-2 px-3 text-[#c9fcfe] focus:outline-none focus:ring-2 focus:ring-blue-500" value="Soluciones en la Nube">
                    </div>
                </div>
                
                <div>
                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-400 mb-1">Tema de color principal</label>
                        <div class="flex items-center">
                            <input type="text" class="flex-grow bg-gray-900 border border-gray-700 rounded-l-md py-2 px-3 text-[#c9fcfe] focus:outline-none focus:ring-2 focus:ring-blue-500" value="#c9fcfe">
                            <div class="h-10 w-10 bg-[#c9fcfe] border border-gray-700 rounded-r-md"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Botones de acción principales -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
    <div class="flex justify-end space-x-4">
        <button class="px-6 py-3 bg-gray-800 text-gray-300 rounded-md hover:bg-gray-700 transition">
            Vista previa
        </button>
        <button class="px-6 py-3 bg-blue-900 text-[#c9fcfe] rounded-md hover:bg-blue-800 transition">
            Guardar todos los cambios
        </button>
        <button class="px-6 py-3 bg-green-900 text-[#c9fcfe] rounded-md hover:bg-green-800 transition">
            Publicar cambios
        </button>
    </div>
</div>

<!-- Enlace de Edición de Homepage -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
    <div class="bg-[#0a0a0a] border border-gray-800 rounded-lg overflow-hidden shadow-lg">
        <div class="border-b border-gray-800 px-6 py-4 bg-gray-900 flex justify-between items-center">
            <h3 class="text-lg font-medium text-[#c9fcfe]">
                <svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 5a1 1 0 011-1h14a1 1 0 011 1v2a1 1 0 01-1 1H5a1 1 0 01-1-1V5zM4 13a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H5a1 1 0 01-1-1v-6zM16 13a1 1 0 011-1h2a1 1 0 011 1v6a1 1 0 01-1 1h-2a1 1 0 01-1-1v-6z"></path>
                </svg>
                Edición del Homepage
            </h3>
            <a href="{{ route('homepage.index') }}" class="px-4 py-2 bg-blue-900 text-[#c9fcfe] rounded-md hover:bg-blue-800 transition flex items-center">
                <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"></path>
                </svg>
                Editar Homepage
            </a>
        </div>
        
        <div class="p-6">
            <p class="text-gray-400">
                Desde esta sección puedes gestionar todo el contenido de la página principal, incluyendo el texto, imágenes y secciones.
            </p>
        </div>
    </div>
</div>

@endsection