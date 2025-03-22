@extends('layouts.app')

@section('title', 'DevCloud Partners - Nuestros Servicios')

@section('content')
<!-- Hero Section Compacta -->
<section class="servicios-banner bg-dark">
    <div class="container">
        <div class="banner-etiqueta-contenedor">
            <span class="banner-etiqueta">Nuestros servicios</span>
        </div>
        
        <h1 class="banner-titulo scroll-reveal delay-1">
            Soluciones tecnológicas para<br>
            impulsar tu <span class="color-destacado">negocio</span>
        </h1>
        
        <p class="banner-descripcion scroll-reveal delay-2">
            Ofrecemos servicios especializados en Cloud Computing, DevOps y 
            Telecomunicaciones para ayudarte a acelerar tu transformación digital.
        </p>
    </div>
</section>

<!-- Sección de Servicios sin Rombos Adicionales -->
<section id="servicios" class="py-16 bg-services text-center relative">
    <!-- Formas geométricas sutiles (las originales) -->
    <div class="shape-disruptor shape-1"></div>
    <div class="shape-disruptor shape-2"></div>
    
    <div class="container mx-auto px-4">
        <span class="services-tag scroll-reveal">{{ $content->services_tag ?? 'Nuestras soluciones' }}</span>
        <h2 class="services-title scroll-reveal">{{ $content->services_title ?? 'Áreas de especialización' }}</h2>
        <p class="services-description scroll-reveal delay-1">
            {{ $content->services_description ?? 'Combinamos conocimiento técnico avanzado con una profunda comprensión de los desafíos empresariales para ofrecer soluciones integrales.' }}
        </p>
        
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
                            <a href="/servicios/{{ Str::slug($servicio->nombre) }}" class="servicio-link">
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
                    <a href="/servicios/cloud-computing" class="servicio-link">
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
                    <a href="/servicios/devops" class="servicio-link">
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
                    <a href="/servicios/telecomunicaciones" class="servicio-link">
                        Más información
                        <svg xmlns="http://www.w3.org/2000/svg" class="servicio-flecha" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                        </svg>
                    </a>
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Sección de Servicios Detallados -->
<section class="tech-servicios-seccion">
    <div class="container">
        @if(isset($servicios) && $servicios->count() > 0)
            @foreach($servicios->where('activo', true) as $index => $servicio)
                <div class="tech-servicio-bloque {{ $index % 2 != 0 ? 'invertido' : '' }}">
                    <div class="tech-servicio-visual">
                        <img src="{{ asset($servicio->imagen) }}" alt="{{ $servicio->titulo }}" class="tech-servicio-img">
                    </div>
                    <div class="tech-servicio-datos">
                        <div class="tech-servicio-tag">{{ $servicio->etiqueta }}</div>
                        <h2 class="tech-servicio-titulo">{{ $servicio->titulo }}</h2>
                        <div class="tech-servicio-separador"></div>
                        <p class="tech-servicio-texto">
                            {{ $servicio->descripcion }}
                        </p>
                        
                        @if($servicio->caracteristicas && $servicio->caracteristicas->count() > 0)
                        <div class="tech-ventajas-grid">
                            @foreach($servicio->caracteristicas->take(4) as $caracteristica)
                            <div class="tech-ventaja-item">
                                <div class="tech-ventaja-icono">
                                    @if(isset($iconos[$caracteristica->icono]))
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        {!! $iconos[$caracteristica->icono] !!}
                                    </svg>
                                    @else
                                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" d="M9.813 15.904L9 18.75l-.813-2.846a4.5 4.5 0 00-3.09-3.09L2.25 12l2.846-.813a4.5 4.5 0 003.09-3.09L9 5.25l.813 2.846a4.5 4.5 0 003.09 3.09L15.75 12l-2.846.813a4.5 4.5 0 00-3.09 3.09z" />
                                    </svg>
                                    @endif
                                </div>
                                <div class="tech-ventaja-contenido">
                                    <h3>{{ $caracteristica->titulo }}</h3>
                                    <p>{{ $caracteristica->descripcion }}</p>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        @endif
                        
                        <a href="/contacto?servicio={{ Str::slug($servicio->nombre) }}" class="tech-btn-info">Solicitar información <span class="flecha">→</span></a>
                    </div>
                </div>
            @endforeach
        @else
            <!-- Servicio 1: Cloud Computing (Estático) -->
            <div class="tech-servicio-bloque">
                <div class="tech-servicio-visual">
                    <img src="/images/cloud-computing.jpg" alt="Cloud Computing" class="tech-servicio-img">
                </div>
                <div class="tech-servicio-datos">
                    <div class="tech-servicio-tag">Cloud Computing</div>
                    <h2 class="tech-servicio-titulo">Potencia tu negocio en la nube</h2>
                    <div class="tech-servicio-separador"></div>
                    <p class="tech-servicio-texto">
                        Nuestros servicios de Cloud Computing te ayudan a aprovechar todo el potencial de la nube,
                        optimizando costes, mejorando la escalabilidad y aumentando la agilidad de tu negocio.
                    </p>
                    
                    <div class="tech-ventajas-grid">
                        <!-- Características estáticas -->
                        <div class="tech-ventaja-item">
                            <div class="tech-ventaja-icono">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M2.25 15a4.5 4.5 0 004.5 4.5H18a3.75 3.75 0 001.332-7.257 3 3 0 00-3.758-3.848 5.25 5.25 0 00-10.233 2.33A4.502 4.502 0 002.25 15z" />
                                </svg>
                            </div>
                            <div class="tech-ventaja-contenido">
                                <h3>Migración a la nube</h3>
                                <p>Diseño y ejecución de estrategias de migración segura y eficiente a entornos cloud.</p>
                            </div>
                        </div>
                        
                        <!-- Más características estáticas... -->
                    </div>
                    
                    <a href="#" class="tech-btn-info">Solicitar información <span class="flecha">→</span></a>
                </div>
            </div>
        @endif
    </div>
</section>

<!-- Sección CTA -->
<section class="cta-section py-20 relative">
    <div class="shape-disruptor shape-2" style="bottom: 20%; left: 10%;"></div>
    
    <div class="container mx-auto px-4 text-center">
        <h2 class="cta-title scroll-reveal">{{ $content->contact_title ?? '¿Necesitas soluciones personalizadas?' }}</h2>
        <p class="cta-description scroll-reveal delay-1">
            {{ $content->contact_description ?? 'Cuéntanos tu proyecto y diseñaremos una solución a medida que se adapte perfectamente a tus necesidades específicas.' }}
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