@extends('layouts.app')

@section('content')
<!-- Banner de Blog Dinámico -->
<section class="blog-banner">
    <div class="container">
        <div class="blog-tag">{{ $configuracion->etiqueta ?? 'Blog y Noticias' }}</div>
        <h1 class="blog-title">{{ $configuracion->titulo_seccion ?? 'Últimas noticias y artículos' }}</h1>
        <p class="blog-description">{{ $configuracion->descripcion ?? 'Mantente al día con las últimas tendencias y novedades sobre Cloud Computing, DevOps y Telecomunicaciones.' }}</p>
    </div>
</section>

<!-- Sección de Búsqueda y Filtros -->
<section class="search-section">
    <div class="container">
        <div class="search-container">
            <div class="search-box">
                <span class="search-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="11" cy="11" r="8"></circle>
                        <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                    </svg>
                </span>
                <form action="{{ route('noticias.index') }}" method="GET">
                    <input type="text" name="buscar" placeholder="Buscar artículos..." value="{{ request('buscar') }}">
                </form>
            </div>
            <div class="filter-tabs">
                <a href="{{ route('noticias.index') }}" class="filter-tab {{ request('categoria') ? '' : 'active' }}">Todas</a>
                @foreach($categorias as $categoria)
                <a href="{{ route('noticias.index', ['categoria' => $categoria->slug]) }}"
                    class="filter-tab {{ request('categoria') == $categoria->slug ? 'active' : '' }}">
                    {{ $categoria->nombre }}
                </a>
                @endforeach
            </div>
        </div>
    </div>
</section>

<!-- Sección de Artículos -->
<section class="articles-section">
    <div class="container">
        @if($noticias->count() > 0)
        <div class="articles-grid">
            @foreach($noticias as $noticia)
            <article class="article-card">
                <div class="article-image">
                    @if($noticia->imagen)
                    <img src="{{ asset('storage/' . $noticia->imagen) }}" alt="{{ $noticia->titulo }}">
                    @else
                    <img src="{{ asset('img/placeholder-noticia.jpg') }}" alt="{{ $noticia->titulo }}">
                    @endif
                </div>
                <div class="article-content">
                    <div class="article-meta">
                        <span class="article-category">
                            @if($noticia->categoria)
                            <!-- Ícono según categoría -->
                            @switch($noticia->categoria->slug)
                            @case('reconocimientos')
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M20 7h-9"></path>
                                <path d="M14 17H5"></path>
                                <circle cx="17" cy="17" r="3"></circle>
                                <circle cx="7" cy="7" r="3"></circle>
                            </svg>
                            @break
                            @case('servicios')
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M21 16V8a2 2 0 0 0-1-1.73l-7-4a2 2 0 0 0-2 0l-7 4A2 2 0 0 0 3 8v8a2 2 0 0 0 1 1.73l7 4a2 2 0 0 0 2 0l7-4A2 2 0 0 0 21 16z"></path>
                                <polyline points="7.5 4.21 12 6.81 16.5 4.21"></polyline>
                                <polyline points="7.5 19.79 7.5 14.6 3 12"></polyline>
                                <polyline points="21 12 16.5 14.6 16.5 19.79"></polyline>
                                <polyline points="3.27 6.96 12 12.01 20.73 6.96"></polyline>
                                <line x1="12" y1="22.08" x2="12" y2="12"></line>
                            </svg>
                            @break
                            @case('eventos')
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M18 20V10"></path>
                                <path d="M12 20V4"></path>
                                <path d="M6 20V14"></path>
                            </svg>
                            @break
                            @default
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                <polyline points="10 9 9 9 8 9"></polyline>
                            </svg>
                            @endswitch
                            {{ $noticia->categoria->nombre }}
                            @else
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                                <polyline points="14 2 14 8 20 8"></polyline>
                                <line x1="16" y1="13" x2="8" y2="13"></line>
                                <line x1="16" y1="17" x2="8" y2="17"></line>
                                <polyline points="10 9 9 9 8 9"></polyline>
                            </svg>
                            General
                            @endif
                        </span>
                        <div>
                            <span class="article-date">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <rect x="3" y="4" width="18" height="18" rx="2" ry="2"></rect>
                                    <line x1="16" y1="2" x2="16" y2="6"></line>
                                    <line x1="8" y1="2" x2="8" y2="6"></line>
                                    <line x1="3" y1="10" x2="21" y2="10"></line>
                                </svg>
                                {{ $noticia->fecha_publicacion->format('d M Y') }}
                            </span>
                            <span class="article-time">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <circle cx="12" cy="12" r="10"></circle>
                                    <polyline points="12 6 12 12 16 14"></polyline>
                                </svg>
                                {{ $noticia->tiempo_lectura ?? '5' }} min
                            </span>
                        </div>
                    </div>
                    <h3 class="article-title">
                        <a href="{{ route('noticias.show', $noticia->slug) }}">
                            {{ $noticia->titulo }}
                        </a>
                    </h3>

                    <!-- Contenido de Tarjeta -->
                    @if($noticia->contenido_tarjeta)
                    <div class="article-description">
                        {{ $noticia->contenido_tarjeta }}
                    </div>
                    @endif

                    <!-- Agregar esta sección para los tags -->
                    @if($noticia->tags->count() > 0)
                    <div class="article-tags">
                        @foreach($noticia->tags as $tag)
                        <a href="{{ route('noticias.index', ['tag' => $tag->slug]) }}" class="article-tag">{{ $tag->nombre }}</a>
                        @endforeach
                    </div>
                    @endif

                    <!-- Botón de Leer más -->
                    <a href="{{ route('noticias.show', $noticia->slug) }}" class="article-read-more">
                        Leer más
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                            <polyline points="12 5 19 12 12 19"></polyline>
                        </svg>
                    </a>
                </div>
            </article>
            @endforeach
        </div>

        <!-- Paginación -->
        <div class="pagination">
            {{ $noticias->appends(request()->query())->links('vendor.pagination.custom') }}
        </div>
        @else
        <div class="no-results text-black">
            <h3 class="text-xl font-semibold">No se encontraron noticias</h3>
            <p class="text-sm mt-2">Intenta con otra búsqueda o categoría</p>
        </div>
        @endif
    </div>

    <!-- Sección Newsletter -->
    <div class="newsletter-section">
    <span class="blog-tag">Newsletter</span>
    
    <h2 class="newsletter-title">Suscríbete a nuestro newsletter</h2>
    
    <p class="newsletter-description">
        Recibe las últimas noticias, artículos y eventos directamente en tu bandeja de entrada.
        No te pierdas ninguna novedad del sector.
    </p>
    
    <div class="newsletter-form">
        <input type="email" placeholder="Tu email" class="newsletter-input">
        <button type="button" class="btn-presupuesto">Suscribirse</button>
    </div>
    
    <p class="newsletter-privacy">
        Puedes darte de baja en cualquier momento. Ver nuestra
        <a href="/privacidad" class="privacy-link">Política de Privacidad</a>.
    </p>
</div>
    <!-- Fin Sección Newsletter -->
</section>
@endsection
