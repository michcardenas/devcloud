@extends('layouts.app')

@section('title', 'Prensa - DevCloud Partners')

@section('content')
<!-- Banner principal (DINÁMICO) -->
<div class="relative bg-[#0a1520] py-20 px-4">
    <!-- Overlay de fondo con patrón de puntos -->
    <div class="absolute inset-0 bg-gradient-to-b from-[#145b7333] to-[#0a152099]"></div>
    <div class="absolute inset-0" style="background-image: radial-gradient(#c9fcfe 1px, transparent 1px); background-size: 30px 30px; opacity: 0.05;"></div>

    <div class="container relative z-10">
        <div class="inline-block px-4 py-2 bg-[#00b8c426] border border-[#00b8c44d] rounded-full text-[#00b8c4] text-sm font-medium mb-6">
            {{ $bannerTextos['etiqueta'] ?? 'Sala de Prensa' }}
        </div>
        <h1 class="text-5xl md:text-6xl font-bold mb-6 text-[#f5f5f5]">{{ $bannerTextos['titulo'] ?? 'Recursos para medios' }}</h1>
        <p class="text-xl text-gray-200 max-w-3xl mb-8">
            {{ $bannerTextos['subtitulo'] ?? 'Toda la información relevante sobre DevCloud Partners para profesionales de los medios de comunicación.' }}
        </p>
    </div>
</div>

<!-- Sección principal de recursos -->
<div class="bg-gradient-to-b from-[#0a1520] to-[#111827] relative py-16 px-4 overflow-hidden">
    <!-- Patrón de puntos de fondo -->
    <div class="absolute inset-0" style="background-image: radial-gradient(#c9fcfe 1px, transparent 1px); background-size: 30px 30px; opacity: 0.05; z-index: 0;"></div>

    <!-- Formas geométricas que flotan -->
    <div class="absolute top-[10%] left-[5%] w-[400px] h-[400px] rounded-full bg-gradient-to-br from-[#00b8c4] to-[#c9fcfe] opacity-15 blur-[80px] z-0"></div>
    <div class="absolute bottom-[10%] right-[5%] w-[350px] h-[350px] rounded-full bg-gradient-to-br from-[#ff7043] to-[#c9fcfe] opacity-15 blur-[80px] z-0"></div>

    <div class="container relative z-10">
        <div class="text-center mb-16">
            <div class="inline-block px-4 py-2 bg-[#00b8c426] border border-[#00b8c44d] rounded-full text-[#00b8c4] text-sm font-medium mb-4">
                {{ $seccionTextos['etiqueta'] ?? 'Sala de prensa' }}
            </div>
            <h2 class="text-4xl font-bold text-[#f5f5f5] mb-4">{{ $seccionTextos['titulo'] ?? 'Recursos para medios' }}</h2>
            <div class="w-20 h-1 bg-gradient-to-r from-[#00b8c4] to-[#00b8c44d] mx-auto mb-6 rounded-full"></div>
            <p class="text-xl text-[#f5f5f5cc] max-w-3xl mx-auto">
                {{ $seccionTextos['subtitulo'] ?? 'Todo lo que necesitas saber sobre DevCloud Partners para medios de comunicación y material de prensa.' }}
            </p>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-8">
            @foreach($categorias as $categoria)
            <div class="bg-[rgba(31,41,55,0.7)] backdrop-blur-md rounded-xl p-6 border border-[#ffffff14] shadow-xl transition-all duration-300 hover:-translate-y-3 hover:border-[#c9fcfe33] relative overflow-hidden">
                <!-- Efecto de línea diagonal -->
                <div class="absolute top-[-100%] left-[-100%] w-[120%] h-[120%] bg-gradient-to-r from-transparent via-[#c9fcfe1a] to-transparent rotate-45 transform -translate-y-full transition-transform duration-700 group-hover:translate-y-full"></div>

                <h3 class="text-2xl font-semibold text-[#f5f5f5] mb-3 relative z-10">{{ $categoria->nombre }}</h3>

                @php
                // Obtener contenido de prensa para esta categoría
                $contenidos = $prensasPorCategoria[$categoria->nombre] ?? [];
                @endphp

                @forelse($contenidos as $contenido)
                <div class="{{ !$loop->last ? 'mb-8 border-b border-[#ffffff14] pb-8' : '' }} relative z-10">
                    <h4 class="text-xl font-semibold text-[#f5f5f5] mb-3 transition-colors duration-300 group-hover:text-[#00b8c4]">{{ $contenido->titulo }}</h4>
                    <p class="text-[#ffffffb3] mb-4">{{ $contenido->descripcion }}</p>
                    @if(isset($contenido->subtipo) && !empty($contenido->subtipo))
                    <div class="mb-4">
                        <span class="inline-block px-2 py-1 bg-[#ffffff0a] rounded-md text-[#f5f5f5aa] text-xs">
                            {{ $contenido->subtipo }}
                        </span>
                    </div>
                    @endif

                    <div class="inline-block px-3 py-1 bg-[#00b8c426] border border-[#00b8c44d] rounded-full text-[#00b8c4] text-xs mb-4">
                        {{ $contenido->fecha_formateada }}
                    </div>

                    @if(isset($contenido->pdf_url) && !empty($contenido->pdf_url))
                    @php
                    $extension = pathinfo($contenido->pdf_url, PATHINFO_EXTENSION);
                    $extensionText = strtoupper($extension);

                    // Si no se puede determinar la extensión, usar "Archivo"
                    if (!$extensionText) {
                    $extensionText = "Archivo";
                    }

                    // Determinar el texto y el icono según la extensión
                    $downloadText = "Descargar " . $extensionText;
                    $iconPath = "M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-4l-4 4m0 0l-4-4m4 4V4";

                    // Si es ZIP, usar un icono diferente
                    if (strtolower($extension) == 'zip' || strtolower($extension) == 'rar') {
                    $iconPath = "M4 16v1a3 3 0 003 3h10a3 3 0 003-3v-1m-4-8l-4-4m0 0L8 8m4-4v12";
                    }
                    @endphp
                    <a href="{{ route('prensa.descargar.pdf', basename($contenido->pdf_url)) }}" class="flex items-center text-[#00b8c4] hover:text-[#c9fcfe] transition-all duration-300 opacity-70 hover:opacity-100 transform translate-y-1 hover:translate-y-0">
                        <span>{{ $downloadText }}</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="{{ $iconPath }}" />
                        </svg>
                    </a>
                    @elseif(isset($contenido->url) && !empty($contenido->url))
                    <a href="{{ $contenido->url }}" class="flex items-center text-[#00b8c4] hover:text-[#c9fcfe] transition-all duration-300 opacity-70 hover:opacity-100 transform translate-y-1 hover:translate-y-0">
                        <span>Leer artículo</span>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3" />
                        </svg>
                    </a>
                    @endif
                </div>
                @empty
                <div class="relative z-10">
                    <p class="text-[#ffffffb3] mb-4">No hay contenido disponible en esta categoría.</p>
                </div>
                @endforelse
            </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Sección de Contacto para Medios (DINÁMICA) -->
<div class="bg-[#f7f9fc] py-16 px-4">
    <div class="container mx-auto">
        <div class="mx-auto max-w-6xl bg-[#f7f2f287] rounded-2xl overflow-hidden shadow-xl">
            <div class="grid md:grid-cols-2 gap-0">
                <div class="p-8 lg:p-12">
                    <h2 class="text-3xl font-bold text-[#0d2b36] mb-4">{{ $contactoTextos['titulo'] ?? 'Contacto para medios' }}</h2>
                    <div class="w-20 h-1 bg-gradient-to-r from-[#00b8c4] to-[#00b8c44d] mb-6 rounded-full"></div>
                    <p class="text-[#212121cc] mb-8">
                        {{ $contactoTextos['descripcion'] ?? 'Si eres periodista o medio de comunicación y necesitas más información, no dudes en contactar con nuestro departamento de comunicación.' }}
                    </p>

                    <div class="mb-6 space-y-4">
                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-11 h-11 bg-[#00b8c426] rounded-lg flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#00b8c4]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-[#0d2b36]">Email:</h3>
                                <a href="mailto:{{ $contactoTextos['email'] ?? 'prensa@devcloud.es' }}" class="text-[#00b8c4] hover:text-[#1e88e5] transition-colors">{{ $contactoTextos['email'] ?? 'prensa@devcloud.es' }}</a>
                            </div>
                        </div>

                        <div class="flex items-start gap-4">
                            <div class="flex-shrink-0 w-11 h-11 bg-[#00b8c426] rounded-lg flex items-center justify-center">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#00b8c4]" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-lg font-semibold text-[#0d2b36]">Teléfono:</h3>
                                <a href="tel:{{ $contactoTextos['telefono_num'] ?? '+34912345867' }}" class="text-[#00b8c4] hover:text-[#1e88e5] transition-colors">{{ $contactoTextos['telefono'] ?? '+34 91 123 45 67' }}</a>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="bg-white p-8 lg:p-12">
                    <h3 class="text-2xl font-bold text-[#0d2b36] mb-4">{{ $suscripcionTextos['titulo'] ?? 'Suscríbete a nuestras notas de prensa' }}</h3>
                    <p class="text-[#212121cc] mb-6">{{ $suscripcionTextos['descripcion'] ?? 'Recibe nuestras notas de prensa y comunicados directamente en tu email.' }}</p>

                    <form action="{{ route('prensa.suscribir') }}" method="POST">
                        @csrf
                        <div class="mb-4">
                            <input type="email"
                                name="email"
                                class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-[#00b8c4] focus:border-transparent transition"
                                placeholder="{{ $suscripcionTextos['placeholder'] ?? 'Tu email profesional' }}"
                                required>
                        </div>

                        <div class="mb-6 flex items-start">
                            <input type="checkbox" name="acepta_politica" id="checkPrivacidad" class="mt-1 mr-2" required>
                            <label for="checkPrivacidad" class="text-sm text-[#212121cc]">
                                {{ $suscripcionTextos['consentimiento'] ?? 'Acepto recibir comunicaciones y la ' }} <a href="#" class="text-[#00b8c4] hover:text-[#1e88e5]">política de privacidad</a>
                            </label>
                        </div>

                        <button type="submit" class="w-full bg-gradient-to-r from-[#0caab7] to-[#08d7fb] text-white font-semibold py-3 px-6 rounded-full hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1">
                            {{ $suscripcionTextos['boton'] ?? 'Suscribirse' }}
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection