<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DevCloud Partners')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

 <!-- Swiper CSS -->
        <link
        rel="stylesheet"
        href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css"
        />

        <!-- Swiper JS -->
        <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

</head>

<body class="bg-black text-white">

    <!-- Navbar -->
    <nav class="navbar ">
    <div class="navbar-container">
        <!-- Logo -->
        <div class="navbar-logo">
            <a href="/">
                <img src="/images/logodev.png" alt="DevCloud Partners">
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
        <a href="#servicios">Servicios</a>
        <a href="#nosotros">Nosotros</a>
        <a href="#noticias">Noticias</a>
        <a href="#prensa">Prensa</a>
        <a href="#unete">Únete</a>
        <a href="#contacto">Contacto</a>
        <a href="#presupuesto" class="btn-presupuesto">Solicitar presupuesto</a>
    </div>
</nav>


    <!-- Contenido -->
    <div class="content pt-20">
        @yield('content')
    </div>

    <!-- Footer con el mismo gradiente que el navbar -->
    <footer class="py-8 text-white bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900">
    <div class="container mx-auto px-6">
        <div class="flex flex-col md:flex-row items-center justify-between space-y-6 md:space-y-0 border-t border-gray-800 pt-6">
            <div class="flex items-center space-x-4">
                <img src="/images/logodev.png" alt="DevCloud Partners" class="h-10">
                <p class="text-gray-500 text-sm">
                    © {{ date('Y') }} Helmcode S.L.. Todos los derechos reservados.
                </p>
            </div>
            <div class="flex space-x-4">
                <a href="{{ url('/terminos') }}" class="text-gray-500 hover:text-cyan-500 text-sm transition-colors">
                    Términos y Condiciones
                </a>
                <span class="text-gray-700">|</span>
                <a href="{{ url('/privacidad') }}" class="text-gray-500 hover:text-cyan-500 text-sm transition-colors">
                    Política de Privacidad
                </a>
            </div>
        </div>
    </div>
</footer>   








    <script src="{{ asset('js/jsdelapagina.js') }}"></script>
  <x-volver-arriba />
</body>

</html>
