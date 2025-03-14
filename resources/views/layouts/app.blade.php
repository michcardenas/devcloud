<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DevCloud Partners')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
</head>

<body class="bg-black text-white">

    <!-- Navbar -->
    <nav class="navbar">
        <div class="navbar-container">
            <div class="navbar-logo">
                <a href="/">
                    <img src="\images\logodev.png" alt="DevCloud Partners">
                </a>
            </div>

            <div class="navbar-links">
                <a href="/">Inicio</a>
                <a href="#servicios">Servicios</a>
                <a href="#casos">Casos de Éxito</a>
                <a href="#contacto">Contacto</a>
            </div>

            <button id="menu-toggle" class="mobile-menu-toggle">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <line x1="3" y1="12" x2="21" y2="12"></line>
                    <line x1="3" y1="6" x2="21" y2="6"></line>
                    <line x1="3" y1="18" x2="21" y2="18"></line>
                </svg>
            </button>
        </div>

        <div id="mobile-menu" class="mobile-menu">
            <a href="/">Inicio</a>
            <a href="#servicios">Servicios</a>
            <a href="#casos">Casos de Éxito</a>
            <a href="#contacto">Contacto</a>
        </div>
    </nav>

    <!-- Contenido -->
    <div class="content pt-20">
        @yield('content')
    </div>

    <!-- Footer con el mismo gradiente que el navbar -->
    <footer class="py-8 text-white mt-20">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center justify-between">
                <div class="mb-6 md:mb-0">
                    <img src="/images/logodev.png" alt="DevCloud Partners" class="h-10">
                </div>
                <div class="text-center md:text-right">
                    <p>&copy; 2025 DevCloud Partners - Todos los derechos reservados.</p>
                </div>
            </div>
        </div>
    </footer>



    <script src="{{ asset('js/jsdelapagina.js') }}"></script>
</body>

</html>