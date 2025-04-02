<!DOCTYPE html>
<html lang="{{ $seo->language_code ?? 'es' }}">

<head>
    <    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    {{-- SEO Metadata --}}
    <title>{{ $seo->meta_title ?? 'Helmcode' }}</title>
    <meta name="description" content="{{ $seo->meta_description ?? '' }}">
    
    @if($seo->meta_keywords ?? false)
    <meta name="keywords" content="{{ $seo->meta_keywords }}">
    @endif
    
    <meta name="robots" content="{{ $seo->meta_robots ?? 'index, follow' }}">

    {{-- Canonical URL --}}
    @if($seo->canonical_url ?? false)
    <link rel="canonical" href="{{ $seo->canonical_url }}">
    @endif

    {{-- Open Graph --}}
    <meta property="og:title" content="{{ $seo->og_title ?? $seo->meta_title ?? 'Helmcode' }}">
    <meta property="og:description" content="{{ $seo->og_description ?? $seo->meta_description ?? '' }}">
    <meta property="og:image" content="{{ $seo->og_image ?? asset('images/logotiporetinaHelmcode.png') }}">
    <meta property="og:type" content="{{ $seo->og_type ?? 'website' }}">
    <meta property="og:url" content="{{ $seo->og_url ?? url()->current() }}">
    <meta property="og:site_name" content="{{ $seo->og_site_name ?? 'Helmcode' }}">
    <meta property="og:locale" content="{{ $seo->og_locale ?? 'es_CO' }}">

    {{-- Twitter Card --}}
    <meta name="twitter:card" content="{{ $seo->twitter_card ?? 'summary_large_image' }}">
    <meta name="twitter:title" content="{{ $seo->twitter_title ?? $seo->meta_title ?? 'Helmcode' }}">
    <meta name="twitter:description" content="{{ $seo->twitter_description ?? $seo->meta_description ?? '' }}">
    
    @if($seo->twitter_image ?? false)
    <meta name="twitter:image" content="{{ $seo->twitter_image }}">
    @endif
    
    @if($seo->twitter_image_alt ?? false)
    <meta name="twitter:image:alt" content="{{ $seo->twitter_image_alt }}">
    @endif
    
    @if($seo->twitter_site ?? false)
    <meta name="twitter:site" content="{{ $seo->twitter_site }}">
    @endif
    
    @if($seo->twitter_creator ?? false)
    <meta name="twitter:creator" content="{{ $seo->twitter_creator }}">
    @endif
    
    {{-- Estilos y scripts --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/faviconHelmcode.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
       
    <!-- Swiper CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />

    <!-- Swiper JS -->
    <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>
    
    @yield('head') {{-- Para añadir elementos adicionales en el head desde las vistas --}}
</head>

<body class="bg-black text-white">

    <!-- Navbar -->
    <nav class="navbar ">
    <div class="navbar-container">
        <!-- Logo -->
        <div class="navbar-logo">
            <a href="/">
                <img class="h-20 w-auto" src="/images/logotiporetinaHelmcode.png" alt="Helmcode">
            </a>
        </div>

        <!-- Enlaces -->
        <div class="navbar-links">
            <a href="/">Inicio</a>
            <a href="{{ route('servicios') }}">Servicios</a>
            <a href="{{ route('nosotros') }}">Nosotros</a>
            <a href="{{ route('noticias.index') }}">Noticias</a>
            <a href="{{ route('prensa.index') }}">Prensa</a>
            <a href="#unete">Únete</a>
            <a href="{{ route('contacto.index') }}">Contacto</a>
            <a href="#presupuesto" class="btn-presupuesto">Solicitar presupuesto</a>
        </div>

        <!-- Botón hamburguesa -->
        <button id="menu-toggle" class="mobile-menu-toggle">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                viewBox="0 0 24 24" fill="none" stroke="currentColor"
                stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                <line x1="3" y1="12" x2="21" y2="12"></line>
                <line x1="3" y1="6" x2="21" y2="6"></line>
                <line x1="3" y1="18" x2="21" y2="18"></line>
            </svg>
        </button>
    </div>

    <!-- Menú móvil -->
    <div id="mobile-menu" class="mobile-menu">
        <a href="/">Inicio</a>
        <a href="{{ route('servicios') }}">Servicios</a>
        <a href="{{ route('nosotros') }}">Nosotros</a>
        <a href="{{ route('noticias.index') }}">Noticias</a>
        <a href="{{ route('prensa.index') }}">Prensa</a>
        <a href="#unete">Únete</a>
        <a href="{{ route('contacto.index') }}">Contacto</a>
        <a href="#presupuesto" class="btn-presupuesto">Solicitar presupuesto</a>
    </div>
</nav>


    <!-- Contenido -->
    <div class="content pt-20">
        @yield('content')
    </div>

    <!-- Footer con el mismo gradiente que el navbar -->
    <footer class="py-10 text-white bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900 border-t border-gray-800">
    <div class="container mx-auto px-6">
        <div class="flex flex-col items-center text-center space-y-6">
            
            {{-- Logo centrado --}}
            <img src="/images/logotiporetinaHelmcode.png" alt="Helmcode" class="h-20 w-auto">

            {{-- Derechos + localización --}}
            <p class="text-sm text-white/70 leading-snug tracking-wide">
                © {{ date('Y') }} Helmcode S.L. · Todos los derechos reservados. <br>
                <span class="text-white/50">Desde Canarias para el 🌍</span>
            </p>

            {{-- Enlaces legales --}}
            <div class="flex flex-wrap justify-center space-x-4 text-sm text-gray-500">
                <a href="{{ url('/terminos') }}" class="hover:text-cyan-500 transition-colors">
                    Términos y Condiciones
                </a>
                <span class="text-gray-700">|</span>
                <a href="{{ url('/privacidad') }}" class="hover:text-cyan-500 transition-colors">
                    Política de Privacidad
                </a>
            </div>

        </div>
    </div>
</footer>   


 <script src="{{ asset('js/jsdelapagina.js') }}"></script>
<!-- Alpine.js -->
<script src="https://cdn.jsdelivr.net/npm/alpinejs@3.14.8/dist/cdn.min.js"></script>


@php
    $cookiePrefs = json_decode(Cookie::get('cookie-preferences') ?? '{}');
@endphp

@if($cookiePrefs->analytics ?? false)
    <!-- Analytics script aquí -->
@endif

@if($cookiePrefs->marketing ?? false)
    <!-- Facebook Pixel, etc -->
@endif



<x-volver-arriba />
<x-cookie-consent />


</body>

</html>