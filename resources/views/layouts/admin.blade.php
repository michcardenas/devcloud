<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'DevCloud Admin') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.1/Sortable.min.js"></script>
    <script src="https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json"></script>

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Estilos personalizados -->
    <link href="{{ asset('css/admin-styles.css') }}" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">

    <style>
        /* Estilos inline para garantizar que se carguen inmediatamente */
        :root {
            --primary-blue: #145b73;
            --accent-blue: #1e88e5;
            --light-blue: #c9fcfe;
            --turquoise: #00b8c4;
            --dark-blue: #0d2b36;
            --bg-dark: #0a1520;
        }

        body {
            font-family: 'Figtree', sans-serif;
            background-color: var(--bg-dark);
            color: var(--light-blue);
        }
    </style>
</head>

<body>
    <div class="auth-container">
        <!-- Formas decorativas en el fondo -->
        <div class="auth-shape auth-shape-1"></div>
        <div class="auth-shape auth-shape-2"></div>

        <div class="auth-card">
            <!-- Logo -->
            <div class="auth-logo">
                <img src="/images/logodev.png" alt="DevCloud Partners">
            </div>

            <!-- Validación de errores -->
            @if ($errors->any())
            <div class="mb-4 p-3 bg-red-900 border-l-4 border-red-500 text-white rounded-md">
                <div class="font-medium">Whoops! Algo salió mal.</div>
                <ul class="mt-3 list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <!-- Contenido -->

            <!-- Contenido principal -->
            @yield('content')

        </div>
    </div>

    <script src="{{ asset('js/admin.js') }}"></script>
</body>

</html>