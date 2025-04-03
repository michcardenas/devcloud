@extends('layouts.app')

@section('title', $servicio->titulonoticia . ' - Helmcode')

@section('content')
<div class="mx-auto p-4 bg-[#0a1520] text-[#f5f5f5]">
  <div class="flex flex-col lg:flex-row gap-8 justify-center max-w-7xl mx-auto">
    <!-- Contenido principal -->
    <article class="lg:flex-grow lg:w-2/3 text-left">
      <!-- Meta información: categoría, fecha y tiempo de lectura -->
      <div class="flex items-center gap-4 mb-6 text-sm">
        <a href="#" class="bg-[#145b73] text-white py-1 px-3 rounded text-sm font-medium hover:bg-[#1e88e5] transition-colors">
        {{ $servicio->titulo }}
        </a>
      </div>

      <!-- Título -->
      <h1 class="text-4xl font-bold mb-6 text-[#f5f5f5]">{{ $servicio->titulonoticia }}</h1>

      <!-- Imagen destacada -->
      <div class="mb-6 text-center">
        <img src="{{ asset( $servicio->imagennoticia) }}" 
             alt="{{ $servicio->titulonoticia }}"
             class="max-w-full h-auto rounded-lg shadow-lg mx-auto">
      </div>

      <!-- Contenido de la noticia -->
      <div class="prose prose-invert prose-lg max-w-none mb-8 text-[#ffffffe6]">
        {!! $servicio->contenido !!}
      </div>

    </article>

    <!-- Sidebar: noticias relacionadas y enlace para volver -->
    <aside class="lg:w-1/3 bg-[#00000033] p-6 rounded-lg h-fit">
  <div class="mb-8 text-center">
    <h2 class="text-xl font-semibold mb-4 text-center text-[#f5f5f5]">Si deseas adquirir uno de nuestros servicios</h2>
    <div class="space-y-4">
      <div class="text-center mb-6">
        <a href="{{ route('contacto.index') }}" 
           class="inline-block bg-gradient-to-r from-[#00b8c4] to-[#1e88e5] text-white py-2 px-5 rounded-full font-medium transition-all hover:-translate-y-1 hover:shadow-lg">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
          </svg>
          Contáctanos
        </a>
      </div>
      <div class="text-center">
        <a href="{{ route('servicios') }}" 
           class="inline-block bg-gradient-to-r from-[#00b8c4] to-[#1e88e5] text-white py-2 px-5 rounded-full font-medium transition-all hover:-translate-y-1 hover:shadow-lg">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
          </svg>
          Volver a Servicios
        </a>
      </div>
    </div>
  </div>
</aside>
  </div>
</div>
@endsection