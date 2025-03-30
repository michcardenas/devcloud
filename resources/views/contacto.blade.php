@extends('layouts.app')

@section('title', 'Contacto')

@section('content')
    <!-- Hero Section -->
    <section class="relative py-20 min-h-[40vh] flex items-center justify-center bg-[#0a1520]">
        <div class="absolute inset-0 z-0 bg-gradient-to-b from-[#145b73]/20 to-[#0a1520]"></div>
        <div class="absolute inset-0 z-0 opacity-5 bg-[url('data:image/svg+xml;utf8,<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"20\" height=\"20\" viewBox=\"0 0 20 20\"><circle cx=\"1\" cy=\"1\" r=\"0.5\" fill=\"rgba(201, 252, 254, 0.15)\"/></svg>')]"></div>
        
        <div class="container mx-auto px-4 z-10">
            <div class="text-center">
                <span class="inline-block px-5 py-2 mb-6 text-[#00b8c4] bg-[#00b8c4]/15 border border-[#00b8c4]/30 rounded-full text-sm font-medium">
                    {{ $content->contact_tag ?? 'Contacto' }}
                </span>
                <h1 class="text-4xl md:text-5xl font-bold mb-4 text-[#f5f5f5]">{{ $content->contact_title ?? 'Hablemos de tu proyecto' }}</h1>
                <p class="max-w-2xl mx-auto text-lg text-white/90 mb-8">
                    {{ $content->contact_description ?? 'Estamos aquí para ayudarte. Contáctanos y descubre cómo nuestras soluciones tecnológicas pueden transformar tu negocio.' }}
                </p>
            </div>
        </div>
    </section>

    <!-- Form Section: Sección de Contacto Modernizada con Tailwind -->
    <section id="contacto" class="py-16 bg-gradient-to-b from-[#0a1520] to-[#0d2b36]/90 relative overflow-hidden">
        <!-- Background patterns -->
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;utf8,<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"20\" height=\"20\" viewBox=\"0 0 20 20\"><circle cx=\"1\" cy=\"1\" r=\"0.5\" fill=\"rgba(201, 252, 254, 0.15)\"/></svg></div>
        
        <!-- Formas geométricas disruptivas -->
        <div class="shape-disruptor shape-1 absolute w-[400px] h-[400px] rounded-full bg-gradient-to-r from-[#00b8c4] to-[#c9fcfe] opacity-10 blur-[80px] z-0" style="top: 20%; left: 10%;"></div>
        <div class="shape-disruptor shape-2 absolute w-[350px] h-[350px] rounded-full bg-gradient-to-r from-[#ff7043] to-[#c9fcfe] opacity-10 blur-[80px] z-0" style="bottom: 10%; right: 10%;"></div>
        
        <div class="container mx-auto px-4 relative z-10">
            <span class="contact-tag scroll-reveal  px-5 py-2 mb-4 text-[#00b8c4] bg-[#00b8c4]/15 border border-[#00b8c4]/30 rounded-full text-sm font-medium mx-auto block text-center">{{ $homeContent->contact_tag ?? 'Contacto' }}</span>
            
            <h2 class="contact-title scroll-reveal text-3xl md:text-4xl font-bold mb-4 text-[#f5f5f5] text-center">{{ $homeContent->contact_title ?? 'Solicita tu cotización' }}</h2>
            
            <p class="contact-description scroll-reveal delay-1 max-w-2xl mx-auto text-lg text-white/80 text-center mb-12">
                {{ $homeContent->contact_description ?? 'Rellena el formulario y nos pondremos en contacto contigo lo antes posible.' }}
            </p>

            <div class="contact-form scroll-reveal zoom-in delay-2 max-w-5xl mx-auto bg-[rgba(31,41,55,0.7)] backdrop-blur-md border border-[#c9fcfe]/10 rounded-2xl overflow-hidden shadow-xl flex flex-col md:flex-row">
                <div class="contact-form-info bg-gradient-to-br from-[#145b73]/80 to-[#0d2b36]/90 p-8 md:w-1/3 flex flex-col">
                    <h3 class="contact-info-title text-2xl font-semibold text-[#00b8c4] mb-6">Información de contacto</h3>
                    
                    <!-- Información de contacto en la parte superior -->
                    <div class="contact-info-group space-y-6">
                        <div class="contact-info-item flex items-start">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#00b8c4]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M22 16.92v3a2 2 0 0 1-2.18 2 19.79 19.79 0 0 1-8.63-3.07 19.5 19.5 0 0 1-6-6 19.79 19.79 0 0 1-3.07-8.67A2 2 0 0 1 4.11 2h3a2 2 0 0 1 2 1.72 12.84 12.84 0 0 0 .7 2.81 2 2 0 0 1-.45 2.11L8.09 9.91a16 16 0 0 0 6 6l1.27-1.27a2 2 0 0 1 2.11-.45 12.84 12.84 0 0 0 2.81.7A2 2 0 0 1 22 16.92z"></path>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-[#00b8c4] font-medium">Teléfono</p>
                                <span class="contact-info-text text-white/90">{{ $content->contact_phone ?? '+34 91 123 45 67' }}</span>
                            </div>
                        </div>

                        <div class="contact-info-item flex items-start">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#00b8c4]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                                    <polyline points="22,6 12,13 2,6"></polyline>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-[#00b8c4] font-medium">Email</p>
                                <span class="contact-info-text text-white/90">{{ $content->contact_email ?? 'info@techwave.es' }}</span>
                            </div>
                        </div>

                        <div class="contact-info-item flex items-start">
                            <div class="w-10 h-10 rounded-full flex items-center justify-center flex-shrink-0 mr-4">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-[#00b8c4]" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"></path>
                                    <circle cx="12" cy="10" r="3"></circle>
                                </svg>
                            </div>
                            <div>
                                <p class="text-sm text-[#00b8c4] font-medium">Dirección</p>
                                <span class="contact-info-text text-white/90">{{ $content->contact_address ?? 'Calle Tecnología 123, 28021, Madrid' }}</span>
                            </div>
                        </div>
                    </div>

                    <!-- Espacio flexible para empujar las redes sociales hacia abajo -->
                    <div class="flex-spacer flex-grow min-h-[40px]"></div>

                    <!-- Redes sociales en la parte inferior -->
                    <div class="contact-social mt-auto">
                        <h4 class="contact-social-title text-base font-medium text-white/80 mb-4">Síguenos en redes sociales</h4>
                        <div class="social-icons flex gap-4">
                            <a href="#" class="social-icon w-10 h-10 rounded-full bg-white/10 flex items-center justify-center transition-all duration-300 hover:bg-[#00b8c4] hover:-translate-y-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"></path>
                                </svg>
                            </a>
                            <a href="#" class="social-icon w-10 h-10 rounded-full bg-white/10 flex items-center justify-center transition-all duration-300 hover:bg-[#00b8c4] hover:-translate-y-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="2" y="2" width="20" height="20" rx="5" ry="5"></rect>
                                    <path d="M16 11.37A4 4 0 1 1 12.63 8 4 4 0 0 1 16 11.37z"></path>
                                    <line x1="17.5" y1="6.5" x2="17.51" y2="6.5"></line>
                                </svg>
                            </a>
                            <a href="#" class="social-icon w-10 h-10 rounded-full bg-white/10 flex items-center justify-center transition-all duration-300 hover:bg-[#00b8c4] hover:-translate-y-1">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <path d="M16 8a6 6 0 0 1 6 6v7h-4v-7a2 2 0 0 0-2-2 2 2 0 0 0-2 2v7h-4v-7a6 6 0 0 1 6-6z"></path>
                                    <rect x="2" y="9" width="4" height="12"></rect>
                                    <circle cx="4" cy="4" r="2"></circle>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="contact-form-fields p-8 md:w-2/3">
                    <form action="{{ route('cotizacion.enviar') }}" method="POST" id="cotizacionForm" class="cotizacion-form">
                        @csrf
                        <input type="hidden" name="formulario" value="solicitud_contacto">
                        
                        @if(session('success'))
                        <div class="mensaje-exito mb-6 bg-[#43a047]/20 border border-[#43a047]/30 rounded-lg p-4 text-white">
                            {{ session('success') }}
                        </div>
                        @endif
                        
                        @if($errors->any())
                        <div class="mensaje-error mb-6 bg-[#ff7043]/20 border border-[#ff7043]/30 rounded-lg p-4 text-white">
                            <ul class="list-disc pl-5">
                                @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                        <div class="input-group">
                                <label for="name" class="input-label block text-sm font-medium text-[#00b8c4] mb-2">Nombre de la empresa</label>
                                <input type="text" id="name" name="nombre" class="input-field w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-white placeholder-white/40 focus:outline-none focus:border-[#00b8c4] focus:ring-2 focus:ring-[#00b8c4]/20 transition-all duration-300" value="{{ old('nombre') }}" placeholder="Nombre de la compañía" required>
                            </div>
                        <div class="form-row grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div class="input-group">
                                <label for="name" class="input-label block text-sm font-medium text-[#00b8c4] mb-2">Nombre</label>
                                <input type="text" id="name" name="nombre" class="input-field w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-white placeholder-white/40 focus:outline-none focus:border-[#00b8c4] focus:ring-2 focus:ring-[#00b8c4]/20 transition-all duration-300" value="{{ old('nombre') }}" placeholder="Tu nombre completo" required>
                            </div>
                          

                            <div class="input-group">
                                <label for="email" class="input-label block text-sm font-medium text-[#00b8c4] mb-2">Correo electrónico</label>
                                <input type="email" id="email" name="email" class="input-field w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-white placeholder-white/40 focus:outline-none focus:border-[#00b8c4] focus:ring-2 focus:ring-[#00b8c4]/20 transition-all duration-300" value="{{ old('email') }}" placeholder="ejemplo@email.com" required>
                            </div>
                        </div>

                        <div class="form-row grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                            <div class="input-group">
                                <label for="phone" class="input-label block text-sm font-medium text-[#00b8c4] mb-2">Teléfono (opcional)</label>
                                <input type="tel" id="phone" name="telefono" class="input-field w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-white placeholder-white/40 focus:outline-none focus:border-[#00b8c4] focus:ring-2 focus:ring-[#00b8c4]/20 transition-all duration-300" value="{{ old('telefono') }}" placeholder="+34 600 000 000">
                            </div>

                            <div class="input-group">
                                <label for="asunto" class="input-label block text-sm font-medium text-[#00b8c4] mb-2">Asunto</label>
                                <input type="text" id="asunto" name="asunto" class="input-field w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-white placeholder-white/40 focus:outline-none focus:border-[#00b8c4] focus:ring-2 focus:ring-[#00b8c4]/20 transition-all duration-300" value="{{ old('asunto') }}" placeholder="Motivo de tu contacto">
                            </div>
                        </div>

                        <div class="input-group mb-6">
                            <label for="message" class="input-label block text-sm font-medium text-[#00b8c4] mb-2">Mensaje</label>
                            <textarea id="message" name="mensaje" class="input-field w-full bg-white/5 border border-white/10 rounded-lg px-4 py-3 text-white placeholder-white/40 focus:outline-none focus:border-[#00b8c4] focus:ring-2 focus:ring-[#00b8c4]/20 transition-all duration-300" placeholder="Escribe tu mensaje aquí" rows="4" required>{{ old('mensaje') }}</textarea>
                        </div>

                        <div class="form-legal mb-6 flex items-center">
                            <input type="checkbox" id="privacidad" name="acepto_privacidad" required {{ old('acepto_privacidad') ? 'checked' : '' }} class="w-4 h-4 bg-white/5 border-white/10 rounded focus:ring-[#00b8c4] focus:ring-2 text-[#00b8c4]">
                            <label for="privacidad" class="legal-label ml-2 text-sm text-white/80">He leído y acepto las <a href="#" class="text-[#00b8c4] hover:underline">condiciones de uso</a> y la <a href="#" class="text-[#00b8c4] hover:underline">política de privacidad</a></label>
                        </div>

                        <button type="submit" class="submit-button inline-flex items-center justify-center px-6 py-3 bg-gradient-to-r from-[#00b8c4] to-[#1e88e5] text-white font-semibold rounded-lg shadow-lg hover:translate-y-[-3px] transition-all duration-300 hover:shadow-[#00b8c4]/30 hover:shadow-xl">
                            Enviar mensaje
                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-5 w-5 ml-2 transition-transform duration-300 group-hover:translate-x-1">
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                                <polyline points="12 5 19 12 12 19"></polyline>
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Brief FAQ Section -->
    <section class="py-16 bg-gradient-to-b from-[#0d2b36]/90 to-[#0a1520] relative">
        <div class="absolute inset-0 bg-[url('data:image/svg+xml;utf8,<svg xmlns=\"http://www.w3.org/2000/svg\" width=\"20\" height=\"20\" viewBox=\"0 0 20 20\"><circle cx=\"1\" cy=\"1\" r=\"0.5\" fill=\"rgba(201, 252, 254, 0.15)\"/></svg></div>
        
        <div class="container mx-auto px-4 relative z-10">
            <div class="text-center mb-12">
                <span class="inline-block px-5 py-2 mb-4 text-[#00b8c4] bg-[#00b8c4]/15 border border-[#00b8c4]/30 rounded-full text-sm font-medium">
                    {{ $content->faq_button_text ?? 'Preguntas frecuentes' }}
                </span>
                <h2 class="text-3xl md:text-4xl font-bold mb-4 text-[#f5f5f5]">{{ $content->faq_title ?? 'Resolvemos tus dudas' }}</h2>
                <p class="max-w-2xl mx-auto text-lg text-white/80">
                    {{ $content->faq_description ?? 'Aquí encontrarás respuestas a las preguntas más comunes sobre nuestros servicios.' }}
                </p>
            </div>
            
            <div class="max-w-3xl mx-auto space-y-6">
                @forelse($faqs as $faq)
                <!-- FAQ Item -->
                <div class="bg-[rgba(31,41,55,0.7)] backdrop-blur-md border border-[#c9fcfe]/10 rounded-xl p-6 transition-all duration-300 hover:border-[#00b8c4]/30 hover:shadow-lg">
                    <h3 class="text-xl font-semibold mb-3 text-[#f5f5f5]">{{ $faq->pregunta }}</h3>
                    <p class="text-white/80">{{ $faq->respuesta }}</p>
                </div>
                @empty
                <!-- Fallback para cuando no hay FAQs -->
                <div class="bg-[rgba(31,41,55,0.7)] backdrop-blur-md border border-[#c9fcfe]/10 rounded-xl p-6 transition-all duration-300 hover:border-[#00b8c4]/30 hover:shadow-lg">
                    <h3 class="text-xl font-semibold mb-3 text-[#f5f5f5]">¿Cuánto tiempo tardan en implementar una solución cloud?</h3>
                    <p class="text-white/80">
                        El tiempo de implementación depende de la complejidad de tu infraestructura actual y los objetivos de migración. En general, un proyecto de migración a la nube puede llevar de 2 a 6 meses, pero ofrecemos una evaluación inicial gratuita para darte un cronograma específico para tu caso.
                    </p>
                </div>
                
                <div class="bg-[rgba(31,41,55,0.7)] backdrop-blur-md border border-[#c9fcfe]/10 rounded-xl p-6 transition-all duration-300 hover:border-[#00b8c4]/30 hover:shadow-lg">
                    <h3 class="text-xl font-semibold mb-3 text-[#f5f5f5]">¿Trabajáis con todos los proveedores cloud?</h3>
                    <p class="text-white/80">
                        Sí, somos partners certificados de los principales proveedores de cloud (AWS, Azure, Google Cloud) y tenemos amplia experiencia en entornos multi-cloud. Recomendamos la solución que mejor se adapte a tus necesidades específicas.
                    </p>
                </div>
                @endforelse
            </div>
        </div>
    </section>
@endsection
