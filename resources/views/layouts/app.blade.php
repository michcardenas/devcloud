<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DevCloud Partners')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="{{ asset('css/styles.css') }}" rel="stylesheet">
</head>
<body class="bg-black text-white">

    <!-- Navbar -->
    <nav class="navbar py-4 px-6 flex items-center justify-between">
        <a href="/">
            <img src="/images/logodev.png" alt="DevCloud Partners" class="h-12">
        </a>
        
        <!-- Menú para pantallas grandes -->
        <ul class="hidden md:flex space-x-8">
            <li><a href="#" class="text-gray-300 hover:text-green-400 transition">Inicio</a></li>
            <li><a href="#" class="text-gray-300 hover:text-green-400 transition">Servicios</a></li>
            <li><a href="#" class="text-gray-300 hover:text-green-400 transition">Casos de Éxito</a></li>
            <li><a href="#" class="text-gray-300 hover:text-green-400 transition">Contacto</a></li>
        </ul>

        <!-- Botón de menú hamburguesa en móviles -->
        <button id="menu-toggle" class="md:hidden text-white focus:outline-none">
            <svg class="w-8 h-8" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7" />
            </svg>
        </button>

        <!-- Menú hamburguesa (oculto por defecto) -->
        <div id="mobile-menu" class="menu absolute top-16 left-0 w-full bg-black text-center p-6 md:hidden">
            <a href="#" class="block py-2 text-gray-300 hover:text-green-400 transition">Inicio</a>
            <a href="#" class="block py-2 text-gray-300 hover:text-green-400 transition">Servicios</a>
            <a href="#" class="block py-2 text-gray-300 hover:text-green-400 transition">Casos de Éxito</a>
            <a href="#" class="block py-2 text-gray-300 hover:text-green-400 transition">Contacto</a>
        </div>
    </nav>

    <!-- Contenido -->
    <div class="content pt-20">
        @yield('content')
    </div>

    <!-- Footer con logo -->
    <footer class="py-8 bg-gray-900 text-white mt-20">
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