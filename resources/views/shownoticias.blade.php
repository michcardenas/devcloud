@extends('layouts.app')

@section('content')
<div class="sn-container">
  <div class="sn-wrapper">
    <!-- Contenido principal -->
    <article class="sn-main">
      <!-- Meta información: categoría, fecha y tiempo de lectura -->
      <div class="sn-meta">
        @if($noticia->categoria)
          <a href="{{ route('noticias.index', ['categoria' => $noticia->categoria->slug]) }}" class="sn-category-link">
            {{ $noticia->categoria->nombre }}
          </a>
        @endif
        <span class="sn-read-info">
          {{ \Carbon\Carbon::parse($noticia->fecha_publicacion)->format('d/m/Y') }} • {{ $noticia->tiempo_lectura }} min de lectura
        </span>
      </div>

      <!-- Título -->
      <h1 class="sn-title">{{ $noticia->titulo }}</h1>

      <!-- Imagen destacada -->
      @if($noticia->imagen)
      <div class="sn-featured-image">
        <img src="{{ asset('storage/' . $noticia->imagen) }}" alt="{{ $noticia->titulo }}">
      </div>
      @endif

      <!-- Contenido de la noticia -->
      <div class="sn-content">
        {!! $noticia->contenido !!}
      </div>

      <!-- Tags relacionados -->
      @if($noticia->tags && $noticia->tags->count() > 0)
      <div class="sn-tags-container">
        <h5>Temas relacionados:</h5>
        <div class="sn-tags-list">
          @foreach($noticia->tags as $tag)
          <a href="{{ route('noticias.index', ['tag' => $tag->slug]) }}" class="sn-tag-item">
            {{ $tag->nombre }}
          </a>
          @endforeach
        </div>
      </div>
      @endif
    </article>

    <!-- Sidebar: noticias relacionadas y enlace para volver -->
    <aside class="sn-sidebar">
      <div class="sn-related-news">
        <header>
          <h2>Noticias relacionadas</h2>
        </header>
        <div class="sn-related-news-list">
          @if($relacionadas->count() > 0)
            @foreach($relacionadas as $noticia_rel)
            <div class="sn-related-news-item">
              <div class="sn-related-news-text">
                <h6>
                  <a href="{{ route('noticias.show', $noticia_rel->slug) }}">
                    {{ $noticia_rel->titulo }}
                  </a>
                </h6>
                <small>
                  {{ \Carbon\Carbon::parse($noticia_rel->fecha_publicacion)->format('d/m/Y') }}
                </small>
              </div>
            </div>
            @endforeach
          @else
            <p>No hay noticias relacionadas disponibles.</p>
          @endif
        </div>
      </div>
      <div class="sn-volver-noticias">
        <a href="{{ route('noticias.index') }}" class="sn-btn-volver">
          <i class="bi bi-arrow-left"></i> Ver todas las noticias
        </a>
      </div>
    </aside>
  </div>
</div>
@endsection
