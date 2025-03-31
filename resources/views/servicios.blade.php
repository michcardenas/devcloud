@extends('layouts.app')

@section('title', 'DevCloud Partners - Nuestros Servicios')

@section('content')
<!-- Hero Section Compacta -->
<section class="servicios-banner bg-dark">
    <div class="container">
        {{-- Tagline --}}
        @if (!empty($serviciosPage->tagline))
            <div class="banner-etiqueta-contenedor">
                <span class="banner-etiqueta">{{ $serviciosPage->tagline }}</span>
            </div>
        @endif

        {{-- Título H1 con última palabra destacada --}}
        @if (!empty($serviciosPage->titulo_h1))
            @php
                $palabras = explode(' ', $serviciosPage->titulo_h1);
                $ultimaPalabra = array_pop($palabras);
                $tituloSinUltima = implode(' ', $palabras);
            @endphp

            <h1 class="banner-titulo scroll-reveal delay-1">
                {!! nl2br(e($tituloSinUltima)) !!} <span class="color-destacado">{{ $ultimaPalabra }}</span>
            </h1>
        @endif

        {{-- Contenido principal --}}
        @if (!empty($serviciosPage->p_contenido))
            <p class="banner-descripcion scroll-reveal delay-2">
                {{ $serviciosPage->p_contenido }}
            </p>
        @endif
    </div>
</section>


<!-- Sección de Servicios sin Rombos Adicionales -->
<section id="servicios" class="py-16 bg-services text-center relative">
    <!-- Formas geométricas sutiles (las originales) -->
    <div class="shape-disruptor shape-1"></div>
    <div class="shape-disruptor shape-2"></div>
    
    <div class="container mx-auto px-4">
    @if (!empty($serviciosPage))
        <span class="services-tag scroll-reveal">
            {{ $serviciosPage->tagline2 ?? 'Nuestras soluciones' }}
        </span>

        <h2 class="services-title scroll-reveal">
            {{ $serviciosPage->sub_h2 ?? 'Áreas de especialización' }}
        </h2>

        <p class="services-description scroll-reveal delay-1">
            {{ $serviciosPage->contenido_2 ?? 'Combinamos conocimiento técnico avanzado con una profunda comprensión de los desafíos empresariales para ofrecer soluciones integrales.' }}
        </p>
    @endif

        
<!-- Servicios dinámicos -->
@if(isset($servicios) && $servicios->count() > 0)
    @php
        $serviciosChunks = $servicios->where('activo', true)->chunk(3);
    @endphp
    
    @foreach($serviciosChunks as $chunk)
        <div class="servicios-grid">
            @foreach($chunk as $index => $servicio)
                <div class="servicio-item scroll-reveal delay-{{ $index + 1 }}">
                    <div class="servicio-icono">
                        @if($servicio->imagen)
                            <img src="{{ asset($servicio->imagen) }}" alt="{{ $servicio->titulo }}" class="servicio-icon-img">
                        @else
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M12 2v6"></path>
                                <path d="M12 22v-6"></path>
                                <path d="M4.93 4.93l4.24 4.24"></path>
                                <path d="M14.83 14.83l4.24 4.24"></path>
                                <path d="M19.07 4.93l-4.24 4.24"></path>
                                <path d="M9.17 14.83l-4.24 4.24"></path>
                                <path d="M2 12h6"></path>
                                <path d="M22 12h-6"></path>
                            </svg>
                        @endif
                    </div>
                    <h3 class="servicio-titulo">{{ $servicio->titulo }}</h3>
                    <p class="servicio-descripcion">
                        {{ Str::limit($servicio->descripcion, 150) }}
                    </p>
                    <a href="{{ route('servicios.show', ['id' => $servicio->id, 'slug' => Str::slug($servicio->nombre)]) }}" class="servicio-link">
                        Más información
                        <svg xmlns="http://www.w3.org/2000/svg" class="servicio-flecha" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            @endforeach
        </div>
    @endforeach
@else
    <div class="servicios-grid">
        <div class="servicio-item scroll-reveal delay-1">
            <div class="servicio-icono">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M18 10h-1.26A8 8 0 1 0 9 20h9a5 5 0 0 0 0-10z"></path>
                </svg>
            </div>
            <h3 class="servicio-titulo">Cloud Computing</h3>
            <p class="servicio-descripcion">
                Migración e implementación de arquitecturas cloud, servicios IaaS, PaaS y SaaS para optimizar recursos y reducir costes.
            </p>
            <a href="{{ route('servicios.show', ['id' => 1, 'slug' => 'cloud-computing']) }}" class="servicio-link">
                Más información
                <svg xmlns="http://www.w3.org/2000/svg" class="servicio-flecha" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
        
        <div class="servicio-item scroll-reveal delay-2">
            <div class="servicio-icono">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <polyline points="16 18 22 12 16 6"></polyline>
                    <polyline points="8 6 2 12 8 18"></polyline>
                </svg>
            </div>
            <h3 class="servicio-titulo">DevOps</h3>
            <p class="servicio-descripcion">
                Automatización de procesos, integración continua y entrega continua (CI/CD), gestión de infraestructura como código (IaC).
            </p>
            <a href="{{ route('servicios.show', ['id' => 2, 'slug' => 'devops']) }}" class="servicio-link">
                Más información
                <svg xmlns="http://www.w3.org/2000/svg" class="servicio-flecha" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
        
        <div class="servicio-item scroll-reveal delay-3">
            <div class="servicio-icono">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M12 2v6"></path>
                    <path d="M12 22v-6"></path>
                    <path d="M4.93 4.93l4.24 4.24"></path>
                    <path d="M14.83 14.83l4.24 4.24"></path>
                    <path d="M19.07 4.93l-4.24 4.24"></path>
                    <path d="M9.17 14.83l-4.24 4.24"></path>
                    <path d="M2 12h6"></path>
                    <path d="M22 12h-6"></path>
                </svg>
            </div>
            <h3 class="servicio-titulo">Telecomunicaciones</h3>
            <p class="servicio-descripcion">
                Diseño e implementación de redes corporativas, soluciones VoIP, conectividad y comunicaciones unificadas.
            </p>
            <a href="{{ route('servicios.show', ['id' => 3, 'slug' => 'telecomunicaciones']) }}" class="servicio-link">
                Más información
                <svg xmlns="http://www.w3.org/2000/svg" class="servicio-flecha" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </a>
        </div>
    </div>
@endif
</section>

<!-- Sección de Servicios Detallados -->
<section class="tech-servicios-seccion">
    <div class="container">
        @if ($serviciosPage)
            {{-- BLOQUE 1 --}}
            <div class="tech-servicio-bloque">
                <div class="tech-servicio-visual">
                    <img src="{{ asset($serviciosPage->imagen1) }}" alt="Imagen 1" class="tech-servicio-img">
                </div>
                <div class="tech-servicio-datos">
                    <div class="tech-servicio-tag">{{ $serviciosPage->tagline3 }}</div>
                    <h2 class="tech-servicio-titulo">{{ $serviciosPage->sub2_h2 }}</h2>
                    <div class="tech-servicio-separador"></div>
                    <p class="tech-servicio-texto">{{ $serviciosPage->contenido_3 }}</p>

                    <div class="tech-ventajas-grid">
                        @for ($i = 1; $i <= 4; $i++)
                            @php
                                $titulo = $serviciosPage->{'titulo_atributo' . $i . '_1'};
                                $contenido = $serviciosPage->{'contenido_atributo' . $i . '_1'};
                                $imagen = $serviciosPage->{'imagen_atributo' . $i . '_1'};
                            @endphp
                            @if ($titulo || $contenido)
                                <div class="tech-ventaja-item">
                                    <div class="tech-ventaja-icono">
                                        @if (!empty($imagen))
                                            <img src="{{ asset($imagen) }}" alt="Icono" style="width: 32px;">
                                        @endif
                                    </div>
                                    <div class="tech-ventaja-contenido">
                                        <h3>{{ $titulo }}</h3>
                                        <p>{{ $contenido }}</p>
                                    </div>
                                </div>
                            @endif
                        @endfor
                    </div>

                    <a href="/contacto" class="tech-btn-info">Solicitar información <span class="flecha">→</span></a>
                </div>
            </div>

            {{-- BLOQUE 2 --}}
            <div class="tech-servicio-bloque tech-servicio-bloque-fondo invertido">
                <div class="tech-servicio-visual">
                    <img src="{{ asset($serviciosPage->imagen2) }}" alt="Imagen 2" class="tech-servicio-img">
                </div>
                <div class="tech-servicio-datos">
                    <div class="tech-servicio-tag">{{ $serviciosPage->tagline5 }}</div>
                    <h2 class="tech-servicio-titulo">{{ $serviciosPage->sub4_h2 }}</h2>
                    <div class="tech-servicio-separador"></div>
                    <p class="tech-servicio-texto">{{ $serviciosPage->contenido_5 }}</p>

                    <div class="tech-ventajas-grid">
                        @for ($i = 1; $i <= 4; $i++)
                            @php
                                $titulo = $serviciosPage->{'titulo_atributo' . $i . '_2'};
                                $contenido = $serviciosPage->{'contenido_atributo' . $i . '_2'};
                                $imagen = $serviciosPage->{'imagen_atributo' . $i . '_2'};
                            @endphp
                            @if ($titulo || $contenido)
                                <div class="tech-ventaja-item">
                                    <div class="tech-ventaja-icono">
                                        @if (!empty($imagen))
                                            <img src="{{ asset($imagen) }}" alt="Icono" style="width: 32px;">
                                        @endif
                                    </div>
                                    <div class="tech-ventaja-contenido">
                                        <h3>{{ $titulo }}</h3>
                                        <p>{{ $contenido }}</p>
                                    </div>
                                </div>
                            @endif
                        @endfor
                    </div>

                    <a href="/contacto" class="tech-btn-info">Solicitar información <span class="flecha">→</span></a>
                </div>
            </div>

            {{-- BLOQUE 3 --}}
            <div class="tech-servicio-bloque ">
                <div class="tech-servicio-visual">
                    <img src="{{ asset($serviciosPage->imagen3) }}" alt="Imagen 3" class="tech-servicio-img">
                </div>
                <div class="tech-servicio-datos">
                    <div class="tech-servicio-tag">{{ $serviciosPage->tagline6 }}</div>
                    <h2 class="tech-servicio-titulo">{{ $serviciosPage->sub6_h2 }}</h2>
                    <div class="tech-servicio-separador"></div>
                    <p class="tech-servicio-texto">{{ $serviciosPage->contenido_6 }}</p>

                    <div class="tech-ventajas-grid">
                        @for ($i = 1; $i <= 4; $i++)
                            @php
                                $titulo = $serviciosPage->{'titulo_atributo' . $i . '_3'};
                                $contenido = $serviciosPage->{'contenido_atributo' . $i . '_3'};
                                $imagen = $serviciosPage->{'imagen_atributo' . $i . '_3'};
                            @endphp
                            @if ($titulo || $contenido)
                                <div class="tech-ventaja-item">
                                    <div class="tech-ventaja-icono">
                                        @if (!empty($imagen))
                                            <img src="{{ asset($imagen) }}" alt="Icono" style="width: 32px;">
                                        @endif
                                    </div>
                                    <div class="tech-ventaja-contenido">
                                        <h3>{{ $titulo }}</h3>
                                        <p>{{ $contenido }}</p>
                                    </div>
                                </div>
                            @endif
                        @endfor
                    </div>

                    <a href="/contacto" class="tech-btn-info">Solicitar información <span class="flecha">→</span></a>
                </div>
            </div>
        @endif
    </div>
</section>


<!-- Sección CTA -->
<section class="cta-section py-20 relative">
    <div class="shape-disruptor shape-2" style="bottom: 20%; left: 10%;"></div>
    
    <div class="container mx-auto px-4 text-center">
    <h2 class="cta-title scroll-reveal">{{ $serviciosPage->sub3_h2 ?? '¿Necesitas soluciones personalizadas?' }}</h2>
    <p class="cta-description scroll-reveal delay-1">
        {{ $serviciosPage->contenido_4 ?? 'Cuéntanos tu proyecto y diseñaremos una solución a medida que se adapte perfectamente a tus necesidades específicas.' }}
    </p>

        
        <div class="cta-buttons scroll-reveal delay-2">
            <button type="button" class="btn btn-white" onclick="location.href='/contacto'">
                Solicitar presupuesto
            </button>
            
            <button type="button" class="btn btn-outline-white" onclick="location.href='/nosotros'">
                Conoce nuestro equipo
            </button>
        </div>
    </div>
</section>
@endsection
