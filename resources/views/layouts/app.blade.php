<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'DevCloud Partners')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <style>
        /* Navbar estilos */
        .navbar {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            background-color: rgba(10, 10, 10, 0.9); /* Negro semi-transparente */
            backdrop-filter: blur(10px); /* Efecto de difuminado */
            transition: background-color 0.3s ease-in-out;
            z-index: 1000;
        }

        .navbar.scrolled {
            background-color: rgba(0, 0, 0, 1); /* Negro sólido cuando se hace scroll */
        }

        /* Estilos para el menú hamburguesa */
        .menu {
            display: none;
        }

        .menu.open {
            display: block;
        }
    </style>
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

    <footer class="py-6 bg-gray-900 text-white text-center mt-20">
        <p>&copy; 2025 DevCloud Partners - Todos los derechos reservados.</p>
    </footer>

    <!-- Script para manejar el menú y scroll -->
    <script>
        document.getElementById("menu-toggle").addEventListener("click", function () {
            document.getElementById("mobile-menu").classList.toggle("open");
        });

        window.addEventListener("scroll", function() {
            let navbar = document.querySelector(".navbar");
            if (window.scrollY > 50) {
                navbar.classList.add("scrolled");
            } else {
                navbar.classList.remove("scrolled");
            }
        });
    </script>

</body>
</html>
