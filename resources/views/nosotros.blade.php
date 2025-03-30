@extends('layouts.app')
@section('content')

<style>
.filtro-btn {
    padding: 0.5rem 1rem;
    font-size: 0.875rem;
    font-weight: 500;
    color: #374151; /* gray-700 */
    background-color: white;
    border-radius: 0.5rem;
    box-shadow: 0 1px 2px rgba(0, 0, 0, 0.05);
    display: flex;
    align-items: center;
    gap: 0.25rem;
    transition: all 0.2s ease-in-out;
    border: none;
}

.filtro-btn:hover {
    background-color: #e0f2fe; /* hover:bg-cyan-100 */
}

.filtro-btn.active {
    background-color: #ecfeff; /* cyan-50 */
    border: 1px solid #06b6d4; /* border-cyan-400 */
    color: #0e7490; /* text-cyan-700 */
    box-shadow: inset 0 1px 3px rgba(0, 0, 0, 0.05);
}

</style>

<section class="nosotros-hero" style="background-image: url('{{ asset($contenido->imagen1) }}');">
    <div class="nosotros-hero-overlay">
        <div class="nosotros-hero-content text-start">
            <span class="nosotros-tagline">
                {{ $contenido->tagline1 }}
            </span>

            <h1 class="nosotros-titulo">
                {{ $contenido->titulo_h1 }}
            </h1>

            <p class="nosotros-descripcion">
                {{ $contenido->contenido1 }}
            </p>

            <div class="nosotros-botones">
                <a href="#historia" class="btn-nosotros btn-primario">Nuestra historia</a>
                <a href="#equipo" class="btn-nosotros btn-secundario">Conoce al equipo</a>
            </div>
        </div>
    </div>
</section>

<section class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex flex-wrap justify-center gap-6">
            @for ($i = 1; $i <= 4; $i++)
            <div class="w-full sm:w-1/2 md:w-[20%] bg-white rounded-xl shadow hover:shadow-lg transition-all p-6 text-center">
            <div class="flex justify-center mb-4">
                        <img src="{{ asset($contenido->{'imagen_tarjeta' . $i}) }}" alt="Icono {{ $i }}" class="w-14 h-14 rounded-full bg-cyan-100 p-2 object-contain">
                    </div>
                    <h4 class="text-xl font-bold text-gray-800">{{ $contenido->{'titulo_tarjeta' . $i} }}</h4>
                    <p class="text-gray-600 mt-1">{{ $contenido->{'contenido_tarjeta' . $i} }}</p>
                </div>
            @endfor
        </div>
    </div>
</section>
<section id="historia" class="bg-white py-16">
    <div class="max-w-7xl mx-auto px-4 grid md:grid-cols-2 gap-10 items-center">
        {{-- Parte izquierda: imagen con card superpuesta --}}
        <div class="relative">
            <img src="{{ asset($contenido->imagen2) }}" alt="Equipo" class="rounded-lg shadow-md w-full object-cover">
            <div class="absolute bottom-[-2rem] left-6 bg-white rounded-xl shadow-md p-6 w-[90%] max-w-sm">
                <h4 class="font-semibold text-lg mb-1 text-cyan-700">Nuestro equipo</h4>
                <p class="text-sm text-gray-600">{{ $contenido->contenido_imagen2 }}</p>
            </div>
        </div>

        {{-- Parte derecha: texto + cards --}}
        <div>
            <span class="inline-block bg-cyan-100 text-cyan-800 px-4 py-1 rounded-full text-sm font-medium mb-2">
                {{ $contenido->tagline2 }}
            </span>
            <h2 class="text-3xl font-bold text-gray-900 mb-4">
                {{ $contenido->titulo_h2 }}
            </h2>
            
            <p class="text-gray-700 mb-6">{{ $contenido->contenido2 }}</p>

            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
    {{-- Misión --}}
    <div class="border rounded-xl p-4 shadow-sm text-center">
        <div class="flex justify-center mb-3">
            <img src="{{ asset($contenido->imagen_mision) }}" alt="Misión" class="w-10 h-10 bg-cyan-100 rounded-full p-2">
        </div>
        <h4 class="font-semibold text-lg mb-1 text-cyan-700">Misión</h4>
        <p class="text-sm text-gray-600">{{ $contenido->mision }}</p>
    </div>

    {{-- Visión --}}
    <div class="border rounded-xl p-4 shadow-sm text-center">
        <div class="flex justify-center mb-3">
            <img src="{{ asset($contenido->imagen_vision) }}" alt="Visión" class="w-10 h-10 bg-cyan-100 rounded-full p-2">
        </div>
        <h4 class="font-semibold text-lg mb-1 text-cyan-700">Visión</h4>
        <p class="text-sm text-gray-600">{{ $contenido->vision }}</p>
    </div>

    {{-- Valores --}}
    <div class="border rounded-xl p-4 shadow-sm text-center">
        <div class="flex justify-center mb-3">
            <img src="{{ asset($contenido->imagen_valores) }}" alt="Valores" class="w-10 h-10 bg-cyan-100 rounded-full p-2">
        </div>
        <h4 class="font-semibold text-lg mb-1 text-cyan-700">Valores</h4>
        <p class="text-sm text-gray-600">{{ $contenido->valores }}</p>
    </div>
</div>

        </div>
    </div>
</section>

<section class="bg-white py-20">
    <div class="max-w-7xl mx-auto px-4">
        {{-- Encabezado --}}
        <div class="text-center mb-12">
            <span class="inline-block bg-cyan-100 text-cyan-800 px-4 py-1 rounded-full text-sm font-medium mb-2">
                {{ $contenido->tagline3 }}
            </span>
            <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
                {{ $contenido->titulo_h2_principios }}
            </h2>
            <p class="text-gray-600 max-w-2xl mx-auto">
                {{ $contenido->contenido_principios }}
            </p>
        </div>

        {{-- Tarjetas --}}
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @for ($i = 5; $i <= 10; $i++)
                @php
                    $imagen = "imagen_tarjeta$i";
                    $titulo = "titulo_tarjeta$i";
                    $contenidoTarjeta = "contenido_tarjeta$i";
                @endphp

                @if (!empty($contenido->$titulo) || !empty($contenido->$contenidoTarjeta))
                <div class="border rounded-xl p-6 shadow-sm bg-white transition-transform duration-300 transform hover:scale-105">
                <div class="flex justify-center mb-4">
                            @if (!empty($contenido->$imagen))
                                <img src="{{ asset($contenido->$imagen) }}" alt="Icono {{ $i }}" class="w-10 h-10 bg-cyan-100 rounded-full p-2">
                            @else
                                <div class="w-10 h-10 bg-cyan-100 rounded-full p-2"></div>
                            @endif
                        </div>
                        <h4 class="text-lg font-semibold text-gray-800 mb-2 text-center">
                            {{ $contenido->$titulo }}
                        </h4>
                        <p class="text-sm text-gray-600 text-center">
                            {{ $contenido->$contenidoTarjeta }}
                        </p>
                    </div>
                @endif
            @endfor
        </div>
    </div>
</section>
<section id="equipo" class="text-center py-16 bg-white">
    {{-- Tagline --}}
    <span class="inline-block bg-cyan-100 text-cyan-800 px-4 py-1 rounded-full text-sm font-medium mb-4">
        {{ $contenido->tagline4 }}
    </span>

    {{-- Título principal --}}
    <h2 class="text-3xl md:text-4xl font-bold text-gray-900 mb-4">
        {{ $contenido->titulo_h2_equipo }}
    </h2>

    {{-- Contenido descriptivo --}}
    <p class="text-gray-600 max-w-2xl mx-auto text-base md:text-lg leading-relaxed">
        {{ $contenido->contenido_equipo }}
    </p>

    {{-- Barra de filtros por departamento --}}
@php
    $departamentos = $colaboradores->pluck('departamento')->unique()->filter()->values();
@endphp



<div class="px-4 py-4 rounded-lg max-w-4xl mx-auto mb-10">
    <div class="flex flex-wrap justify-center gap-3">

        {{-- Botón "Todos" --}}
        <button 
            onclick="filtrarColaboradores(this)" 
            data-depto="Todos" 
            class="filtro-btn active"
        >
            <i class="fas fa-users mr-1"></i> Todos
        </button>

        {{-- Botones por departamento --}}
        @foreach ($departamentos as $depto)
            <button 
                onclick="filtrarColaboradores(this)" 
                data-depto="{{ $depto }}" 
                class="filtro-btn"
            >
                @switch($depto)
                    @case('Fundadores')
                        <i class="fas fa-user-tie mr-1"></i>
                        @break
                    @case('Desarrollo')
                        <i class="fas fa-code mr-1"></i>
                        @break
                    @case('Marketing')
                        <i class="fas fa-bullhorn mr-1"></i>
                        @break
                    @case('Diseño')
                        <i class="fas fa-paint-brush mr-1"></i>
                        @break
                    @default
                        <i class="fas fa-briefcase mr-1"></i>
                @endswitch
                {{ $depto }}
            </button>
        @endforeach

    </div>
</div>





<div id="tituloEquipo" class="text-center mb-10">
        <h3 class="text-lg text-cyan-600 font-semibold">Todos los miembros</h3>
        <p class="text-sm text-gray-500">Mostrando {{ $colaboradores->count() }} colaboradores</p>
    </div>
    <div id="contenedorColaboradores" class="grid gap-6 grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 justify-items-center">
    @foreach($colaboradores as $colaborador)
        <div class="relative group w-full max-w-xs bg-white rounded-xl shadow-md overflow-hidden group hover:shadow-lg transition duration-300 ease-in-out colaborador-card" data-departamento="{{ $colaborador->departamento }}">
            <div class="relative h-52 w-full overflow-hidden">
                <img src="{{ asset($colaborador->imagen) }}" alt="{{ $colaborador->nombre }}" class="w-full h-full object-cover transform group-hover:scale-105 transition duration-300">
           
                             {{-- Descripción flotante --}}
    @if($colaborador->descripcion)
        <div class="absolute inset-0 bg-black bg-opacity-70 text-white opacity-0 group-hover:opacity-100 transition duration-300 flex items-center justify-center text-sm text-center p-4">
            {{ $colaborador->descripcion }}
        </div>
    @endif

             </div>


            <div class="p-4">
                <h4 class="text-gray-900 font-semibold text-lg">{{ $colaborador->nombre }}</h4>
                <p class="text-sm text-cyan-600 font-medium">{{ $colaborador->cargo }}</p>  
                @if($colaborador->linkedin)
                    <a href="{{ $colaborador->linkedin }}" target="_blank" class="inline-block mt-3 text-gray-500 hover:text-cyan-600">
                        <i class="fab fa-linkedin text-xl"></i>
                    </a>
                @endif
            </div>
        </div>
    @endforeach
</div>

<script>

//Filtro departamento
function filtrarColaboradores(btn) {
    const departamento = btn.getAttribute('data-depto');
    const cards = document.querySelectorAll('.colaborador-card');
    const titulo = document.getElementById('tituloEquipo');
    const botones = document.querySelectorAll('.filtro-btn');

    let totalMostrados = 0;

    cards.forEach(card => {
        const depto = card.getAttribute('data-departamento');
        const visible = (departamento === 'Todos' || depto === departamento);
        card.classList.toggle('hidden', !visible);
        if (visible) totalMostrados++;
    });

    // Actualizar título
    titulo.innerHTML = `
        <h3 class="text-lg text-cyan-600 font-semibold">
            ${departamento}
        </h3>
        <p class="text-sm text-gray-500">Mostrando ${totalMostrados} colaborador${totalMostrados !== 1 ? 'es' : ''}</p>
    `;

    // Marcar botón activo
    botones.forEach(b => b.classList.remove('active'));
    btn.classList.add('active');
}



</script>


</section>





@endsection
