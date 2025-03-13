<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'DevCloud Admin') }}</title>

    <!-- Fuentes y estilos -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Vite -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    
    <!-- Alpine.js CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <style>
        /* Estilos para el layout de autenticación con fondo negro */
        body {
            background-color: #030e12;
            color: #c9fcfe;
            font-family: 'Figtree', sans-serif;
        }
        
        .auth-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 1rem;
        }
        
        .auth-card {
            background-color: #0a0a0a;
            border: 1px solid #1f1f1f;
            border-radius: 0.5rem;
            padding: 2rem;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 400px;
        }
        
        .auth-logo {
            display: flex;
            justify-content: center;
            margin-bottom: 1rem;
        }
        
        .auth-btn {
            display: inline-block;
            padding: 0.5rem 1.5rem;
            border-radius: 0.375rem;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
            background-color: #145b73;
            color: #c9fcfe;
        }
        
        .auth-btn:hover {
            background-color: #0d4559;
        }

        /* Opción 1: Modificar los estilos globales en tu archivo CSS principal */
input[type=text], input:where(:not([type])), input[type=email], 
input[type=url], input[type=password], input[type=number], 
input[type=date], input[type=datetime-local], input[type=month], 
input[type=search], input[type=tel], input[type=time], 
input[type=week], [multiple], textarea, select {
    -webkit-appearance: none;
    -moz-appearance: none;
    appearance: none;
    background-color: transparent; /* Cambiado de #fff a transparent */
    font-size: 1rem;
    line-height: 1.5rem;
    --tw-shadow: 0 0 #0000;
}

/* Opción 2: Crear una clase específica que sobrescriba el estilo global */
.bg-transparent-input {
    background-color: transparent !important;
}

/* Opción 3: Usar la estrategia de especificidad CSS */
.auth-form input[type=email],
.auth-form input[type=password],
.auth-form input[type=checkbox] {
    background-color: transparent;
}

.focus\:ring-2:focus {
    /* Las otras propiedades se mantienen igual */
    --tw-ring-color: #c9fcfe; /* O el color que prefieras */
}

    </style>
</head>
<body>
    <div class="auth-container">
        <div class="auth-card">
            <!-- Logo -->
            <div class="auth-logo">
                <img src="/images/logodev.png" alt="DevCloud Partners" class="h-10">
            </div>
            <!-- Contenido de la vista (slot) -->
            {{ $slot }}
        </div>
    </div>
</body>
</html>
