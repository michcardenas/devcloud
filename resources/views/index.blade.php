@extends('layouts.app')

@section('title', 'DevCloud Partners - Soluciones en la Nube')

@section('content')

<!-- Hero Section con estadísticas -->
<section class="hero-section scroll-reveal" data-bg-image="{{ $content->hero_bg_image ? asset('storage/'.$content->hero_bg_image) : '/images/cloud-dark-bg.jpg' }}">
    <div class="hero-container">
        <div class="hero-content scroll-reveal delay-1">
            <span class="tag-line scroll-reveal delay-2">{{ $content->hero_tagline }}</span>
            <h1 class="hero-title scroll-reveal delay-2">{{ $content->hero_title_1 }} <span class="highlight">empresas</span> a través <br>de la <span class="highlight">{{ $content->hero_title_2 }}</span></h1>

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
                <div class="service-card scroll-reveal delay-{{ min($index + 1, 3) }}">
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
                <div class="service-card scroll-reveal delay-1">
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
                            <select id="servicio" name="servicio" class="input-field" required>
                                <option value="" disabled {{ old('servicio') ? '' : 'selected' }}>Selecciona un servicio</option>
                                <option value="Desarrollo Web" {{ old('servicio') == 'Desarrollo Web' ? 'selected' : '' }}>Desarrollo Web</option>
                                <option value="Desarrollo Móvil" {{ old('servicio') == 'Desarrollo Móvil' ? 'selected' : '' }}>Desarrollo Móvil</option>
                                <option value="Servicios Cloud" {{ old('servicio') == 'Servicios Cloud' ? 'selected' : '' }}>Servicios Cloud</option>
                                <option value="Consultoría Tecnológica" {{ old('servicio') == 'Consultoría Tecnológica' ? 'selected' : '' }}>Consultoría Tecnológica</option>
                                <option value="Diseño UX/UI" {{ old('servicio') == 'Diseño UX/UI' ? 'selected' : '' }}>Diseño UX/UI</option>
                                <option value="Otro" {{ old('servicio') == 'Otro' ? 'selected' : '' }}>Otro</option>
                            </select>
                        </div>
                    </div>

                    <div class="input-group">
                        <label for="region" class="input-label">Región</label>
                        <select id="region" name="region" class="input-field" required>
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
                        <select id="presupuesto" name="presupuesto" class="input-field" required>
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