@extends('layouts.app')

@section('content')
<div class="mx-auto p-4 bg-[#0a1520] text-[#f5f5f5]">
  <div class="flex flex-col lg:flex-row gap-8 justify-center max-w-7xl mx-auto">
    <!-- Contenido principal -->
    <article class="lg:flex-grow lg:w-2/3 text-left">
      <!-- Meta información: categoría, fecha y tiempo de lectura -->
      <div class="flex items-center gap-4 mb-6 text-sm">
        @if($noticia->categoria)
          <a href="{{ route('noticias.index', ['categoria' => $noticia->categoria->slug]) }}" 
             class="bg-[#145b73] text-white py-1 px-3 rounded text-sm font-medium hover:bg-[#1e88e5] transition-colors">
            {{ $noticia->categoria->nombre }}
          </a>
        @endif
        <span class="text-[#ffffffb3]">
          {{ \Carbon\Carbon::parse($noticia->fecha_publicacion)->format('d/m/Y') }} • {{ $noticia->tiempo_lectura }} min de lectura
        </span>
      </div>

      <!-- Título -->
      <h1 class="text-4xl font-bold mb-6 text-[#f5f5f5]">{{ $noticia->titulo }}</h1>

      <!-- Imagen destacada -->
      @if($noticia->imagen)
      <div class="mb-6 text-center">
        <img src="{{ asset($noticia->imagen) }}" 
             alt="{{ $noticia->titulo }}"
             class="max-w-full h-auto rounded-lg shadow-lg mx-auto">
      </div>
      @endif

      <!-- Contenido de la noticia -->
      <div class="prose prose-invert prose-lg max-w-none mb-8 text-[#ffffffe6]">
        {!! $noticia->contenido !!}
      </div>

      <!-- Tags relacionados -->
      @if($noticia->tags && $noticia->tags->count() > 0)
      <div class="mt-10 mb-8">
        <h5 class="text-lg font-medium text-[#00b8c4] mb-4 text-center">Temas relacionados:</h5>
        <div class="flex flex-wrap gap-2 justify-center">
          @foreach($noticia->tags as $tag)
          <a href="{{ route('noticias.index', ['tag' => $tag->slug]) }}" 
             class="px-3 py-1 bg-[#ffffff14] hover:bg-[#ffffff29] text-[#f5f5f5] rounded-full text-sm transition-colors">
            {{ $tag->nombre }}
          </a>
          @endforeach
        </div>
      </div>
      @endif
    </article>

    <!-- Sidebar: noticias relacionadas y enlace para volver -->
    <aside class="lg:w-1/3 bg-[#00000033] p-6 rounded-lg h-fit">
      <div class="mb-8">
        <header>
          <h2 class="text-xl font-semibold mb-4 text-center text-[#f5f5f5]">Noticias relacionadas</h2>
        </header>
        <div class="space-y-4">
          @if($relacionadas->count() > 0)
            @foreach($relacionadas as $noticia_rel)
            <div class="pb-4 border-b border-[#ffffff1a] last:border-0">
              <div class="text-center">
                <h6 class="mb-1">
                  <a href="{{ route('noticias.show', $noticia_rel->slug) }}" 
                     class="text-[#f5f5f5] hover:text-[#00b8c4] transition-colors">
                    {{ $noticia_rel->titulo }}
                  </a>
                </h6>
                <small class="text-[#ffffffb3] text-sm">
                  {{ \Carbon\Carbon::parse($noticia_rel->fecha_publicacion)->format('d/m/Y') }}
                </small>
              </div>
            </div>
            @endforeach
          @else
            <p class="text-center text-[#ffffffb3]">No hay noticias relacionadas disponibles.</p>
          @endif
        </div>
      </div>
      <div class="text-center">
        <a href="{{ route('noticias.index') }}" 
           class="inline-block bg-gradient-to-r from-[#00b8c4] to-[#1e88e5] text-white py-2 px-5 rounded-full font-medium transition-all hover:-translate-y-1 hover:shadow-lg">
          <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 inline mr-2" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
          </svg>
          Ver todas las noticias
        </a>
      </div>
    </aside>
  </div>
</div>
@endsection