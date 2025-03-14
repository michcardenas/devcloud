@extends('layouts.app')

@section('title', 'DevCloud Partners - Soluciones en la Nube')

@section('content')

<!-- Hero Section Modernizado -->
<section class="hero-section fade-item" data-bg-image="/images/cloud-dark-bg.jpg">
    <div class="hero-content">
        <h1 class="text-5xl font-bold">Soluciones Cloud a la Medida de tu Negocio</h1>
        <p class="mt-4 text-lg">Optimiza, escala y protege tu infraestructura con nuestras soluciones en la nube.</p>
        <button type="button" class="mt-6 btn btn-primary py-3 px-6 rounded-lg" onclick="location.href='#contacto'">
            Contáctanos
        </button>
    </div>
</section>

<!-- Sección de Servicios con fondo oscuro y elementos gráficos modernos -->
<section class="py-20 bg-services text-center relative">
    <!-- Formas geométricas disruptivas -->
    <div class="shape-disruptor shape-1"></div>
    <div class="shape-disruptor shape-2"></div>

    <h2 class="text-4xl font-bold text-white">Nuestros Servicios</h2>
    <p class="text-lg text-gray-400 mt-4">Soluciones tecnológicas avanzadas para impulsar tu empresa</p>

    <div class="mt-10 grid grid-cols-1 md:grid-cols-3 gap-8 max-w-6xl mx-auto px-4">
        <!-- Tarjeta 1 - Cloud Computing -->
        <div class="service-card">
            <img src="/images/cloud_done_24dp_E3E3E3_FILL0_wght400_GRAD0_opsz24.png" alt="Cloud Services" class="w-16 mx-auto">
            <h3 class="text-2xl font-bold text-white mt-4">Cloud Computing</h3>
            <p class="mt-2 text-gray-400">Infraestructura segura y escalable con AWS, Azure y Google Cloud.</p>
            <svg class="card-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </div>

        <!-- Tarjeta 2 - DevOps -->
        <div class="service-card">
            <img src="/images/all_inclusive_24dp_E3E3E3_FILL0_wght400_GRAD0_opsz24.png" alt="DevOps" class="w-16 mx-auto">
            <h3 class="text-2xl font-bold text-white mt-4">DevOps</h3>
            <p class="mt-2 text-gray-400">Automatización y CI/CD para optimizar tu desarrollo.</p>
            <svg class="card-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </div>

        <!-- Tarjeta 3 - Ciberseguridad -->
        <div class="service-card">
            <img src="/images/encrypted_24dp_E3E3E3_FILL0_wght400_GRAD0_opsz24.png" alt="Cyber Security" class="w-16 mx-auto">
            <h3 class="text-2xl font-bold text-white mt-4">Ciberseguridad</h3>
            <p class="mt-2 text-gray-400">Protección avanzada contra ataques y vulnerabilidades.</p>
            <svg class="card-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="5" y1="12" x2="19" y2="12"></line>
                <polyline points="12 5 19 12 12 19"></polyline>
            </svg>
        </div>
    </div>
</section>

<!-- Sección de Contacto Modernizada -->
<section id="contacto" class="py-20 text-white text-center bg-devcloud relative">
    <!-- Forma geométrica disruptiva adicional -->
    <div class="shape-disruptor shape-1" style="opacity: 0.1; top: 60%; left: 20%;"></div>

    <h2 class="text-4xl font-bold">Contáctanos</h2>
    <p class="text-lg mt-4">Agenda una reunión con nuestros expertos</p>

    <form class="mt-10 max-w-2xl mx-auto bg-dark bg-opacity-50 p-8 rounded-lg backdrop-blur-md border border-gray-800">
        <div class="mb-4">
            <input type="text" placeholder="Tu Nombre" class="block w-full p-3 rounded-lg mb-4 text-gray-900 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
        </div>
        <div class="mb-4">
            <input type="email" placeholder="Tu Correo" class="block w-full p-3 rounded-lg mb-4 text-gray-900 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition">
        </div>
        <div class="mb-4">
            <textarea placeholder="Tu Mensaje" class="block w-full p-3 rounded-lg mb-4 text-gray-900 bg-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-500 transition" rows="4"></textarea>
        </div>
        <button class="mt-6 btn btn-primary py-3 px-8 rounded-lg">Enviar</button>
    </form>
</section>

@endsection