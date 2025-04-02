@extends('layouts.admin')

@section('content')
<!-- Menú de pestañas -->
<ul class="servicio-tabs nav nav-tabs" id="seoTabs" role="tablist">
    <li class="nav-item" role="presentation">
        <button class="servicio-tab-link nav-link {{ !isset($editSeo) && !request()->is('*/create') ? 'active' : '' }}"
            id="lista-tab" data-bs-toggle="tab" data-bs-target="#lista-tab-pane"
            type="button" role="tab" aria-controls="lista-tab-pane" aria-selected="true">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16m-7 6h7"></path>
            </svg>
            Listado SEO
        </button>
    </li>
    <li class="nav-item" role="presentation">
        <button class="servicio-tab-link nav-link {{ request()->is('*/create') ? 'active' : '' }}"
            id="nuevo-tab" data-bs-toggle="tab" data-bs-target="#nuevo-tab-pane"
            type="button" role="tab" aria-controls="nuevo-tab-pane" aria-selected="false">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
            Añadir SEO
        </button>
    </li>
    @if(isset($editSeo))
    <li class="nav-item" role="presentation">
        <button class="servicio-tab-link nav-link active"
            id="editar-tab" data-bs-toggle="tab" data-bs-target="#editar-tab-pane"
            type="button" role="tab" aria-controls="editar-tab-pane" aria-selected="false">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
            </svg>
            Editar SEO
        </button>
    </li>
    @endif
</ul>

<!-- Contenido de las pestañas -->
<div class="servicio-tab-content" id="seoTabsContent">
    <!-- Pestaña: Listado SEO -->
    <table id="seo_dataTable" class="servicio-table">
        <thead>
            <tr>
                <th width="5%">ID</th>
                <th width="15%">Página (Slug)</th>
                <th width="25%">Título</th>
                <th width="30%">Descripción</th>
                <th width="10%">Indexable</th>
                <th width="15%">Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach($seoMetadata as $seo)
            <tr>
                <td>{{ $seo->id }}</td>
                <td>{{ $seo->page_slug }}</td>
                <td>{{ Str::limit($seo->meta_title, 40) }}</td>
                <td>{{ Str::limit($seo->meta_description, 60) }}</td>
                <td>
                    @if(str_contains($seo->meta_robots ?? 'index', 'noindex'))
                    <span class="servicio-badge servicio-badge-danger">No indexable</span>
                    @else
                    <span class="servicio-badge servicio-badge-success">Indexable</span>
                    @endif
                </td>
                <td>
                    <div class="servicio-d-flex">
                        <a href="{{ route('admin.seo.edit', $seo->id) }}" class="servicio-btn servicio-btn-warning servicio-btn-sm">
                            <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                            </svg>
                            Editar
                        </a>
                        <form action="{{ route('admin.seo.destroy', $seo->id) }}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="servicio-btn servicio-btn-danger servicio-btn-sm" onclick="return confirm('¿Estás seguro de eliminar los metadatos SEO para {{ $seo->page_slug }}?')">
                                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"></path>
                                </svg>
                                Eliminar
                            </button>
                        </form>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Pestaña: Añadir SEO -->
    <div class="servicio-tab-pane tab-pane {{ request()->is('*/create') ? 'active show' : '' }}"
        id="nuevo-tab-pane" role="tabpanel" aria-labelledby="nuevo-tab" tabindex="0">
        <div class="servicio-card-body">
            <form action="{{ route('admin.seo.store') }}" method="POST">
                @csrf

                <div class="servicio-row">
                    <div class="servicio-col-12">
                        <div class="servicio-form-group">
                            <label for="page_slug" class="servicio-label">Slug de la página <span class="text-danger">*</span></label>
                            <input type="text" class="servicio-input" id="page_slug" name="page_slug"
                                placeholder="home, servicios, nosotros, etc." required>
                            <small class="servicio-helper-text">Identificador único para la página (sin '/')</small>
                        </div>
                    </div>
                </div>

                <!-- Pestañas para los campos -->
                <ul class="nav nav-tabs mb-3 mt-4" id="seoSubTabs" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active text-light" id="basic-tab" data-bs-toggle="tab"
                            data-bs-target="#basic-content" type="button" role="tab">Básico</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-light" id="og-tab" data-bs-toggle="tab"
                            data-bs-target="#og-content" type="button" role="tab">Open Graph</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link text-light" id="twitter-tab" data-bs-toggle="tab"
                            data-bs-target="#twitter-content" type="button" role="tab">Twitter Card</button>
                    </li>
                </ul>

                <div class="tab-content">
                    <!-- Pestaña: Básico -->
                    <div class="tab-pane fade show active" id="basic-content" role="tabpanel">
                        <div class="servicio-row">
                            <div class="servicio-col-12">
                                <div class="servicio-form-group">
                                    <label for="meta_title" class="servicio-label">Título</label>
                                    <input type="text" class="servicio-input" id="meta_title" name="meta_title"
                                        value="{{ old('meta_title', $editSeo->meta_title ?? '') }}"
                                        placeholder="Título de la página" maxlength="60">
                                    <small class="servicio-helper-text">Recomendado: 50-60 caracteres</small>
                                </div>
                            </div>
                            <div class="servicio-col-12">
                                <div class="servicio-form-group">
                                    <label for="meta_description" class="servicio-label">Descripción</label>
                                    <textarea class="servicio-textarea" id="meta_description" name="meta_description"
                                        rows="3" maxlength="160" placeholder="Descripción breve de la página">{{ old('meta_description', $editSeo->meta_description ?? '') }}</textarea>
                                    <small class="servicio-helper-text">Recomendado: 150-160 caracteres</small>
                                </div>
                            </div>
                            <div class="servicio-col-12">
                                <div class="servicio-form-group">
                                    <label for="meta_keywords" class="servicio-label">Palabras clave</label>
                                    <textarea class="servicio-textarea" id="meta_keywords" name="meta_keywords"
                                        rows="2" placeholder="palabra1, palabra2, palabra3">{{ old('meta_keywords', $editSeo->meta_keywords ?? '') }}</textarea>
                                </div>
                            </div>
                            <div class="servicio-col-6">
                                <div class="servicio-form-group">
                                    <label for="meta_robots" class="servicio-label">Robots</label>
                                    <select class="servicio-select" id="meta_robots" name="meta_robots">
                                        <option value="index, follow" {{ (old('meta_robots', $editSeo->meta_robots ?? '') == 'index, follow') ? 'selected' : '' }}>index, follow</option>
                                        <option value="index, nofollow" {{ (old('meta_robots', $editSeo->meta_robots ?? '') == 'index, nofollow') ? 'selected' : '' }}>index, nofollow</option>
                                        <option value="noindex, follow" {{ (old('meta_robots', $editSeo->meta_robots ?? '') == 'noindex, follow') ? 'selected' : '' }}>noindex, follow</option>
                                        <option value="noindex, nofollow" {{ (old('meta_robots', $editSeo->meta_robots ?? '') == 'noindex, nofollow') ? 'selected' : '' }}>noindex, nofollow</option>
                                    </select>
                                </div>
                            </div>
                            <div class="servicio-col-6">
                                <div class="servicio-form-group">
                                    <label for="canonical_url" class="servicio-label">URL Canónica</label>
                                    <input type="url" class="servicio-input" id="canonical_url" name="canonical_url"
                                        value="{{ old('canonical_url', $editSeo->canonical_url ?? '') }}"
                                        placeholder="https://devcloud.com/pagina">
                                </div>
                            </div>
                            <div class="servicio-col-6">
                                <div class="servicio-form-group">
                                    <label for="language_code" class="servicio-label">Idioma</label>
                                    <select class="servicio-select" id="language_code" name="language_code">
                                        <option value="es" {{ (old('language_code', $editSeo->language_code ?? '') == 'es') ? 'selected' : '' }}>Español (es)</option>
                                        <option value="en" {{ (old('language_code', $editSeo->language_code ?? '') == 'en') ? 'selected' : '' }}>Inglés (en)</option>
                                        <option value="es-ES" {{ (old('language_code', $editSeo->language_code ?? '') == 'es-ES') ? 'selected' : '' }}>Español de España (es-ES)</option>
                                        <option value="es-CO" {{ (old('language_code', $editSeo->language_code ?? '') == 'es-CO') ? 'selected' : '' }}>Español de Colombia (es-CO)</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pestaña: Open Graph -->
                    <div class="tab-pane fade" id="og-content" role="tabpanel">
                        <div class="servicio-row">
                            <div class="servicio-col-12">
                                <div class="servicio-form-group">
                                    <label for="og_title" class="servicio-label">Título OG</label>
                                    <input type="text" class="servicio-input" id="og_title" name="og_title"
                                        value="{{ old('og_title', $editSeo->og_title ?? '') }}"
                                        placeholder="Título para compartir en redes sociales">
                                </div>
                            </div>
                            <div class="servicio-col-12">
                                <div class="servicio-form-group">
                                    <label for="og_description" class="servicio-label">Descripción OG</label>
                                    <textarea class="servicio-textarea" id="og_description" name="og_description"
                                        rows="3" placeholder="Descripción para compartir en redes sociales">{{ old('og_description', $editSeo->og_description ?? '') }}</textarea>
                                </div>
                            </div>
                            <div class="servicio-col-12">
                                <div class="servicio-form-group">
                                    <label for="og_image" class="servicio-label">Imagen OG</label>
                                    <input type="url" class="servicio-input" id="og_image" name="og_image"
                                        value="{{ old('og_image', $editSeo->og_image ?? '') }}"
                                        placeholder="https://devcloud.com/images/og-image.jpg">
                                    <small class="servicio-helper-text">URL completa a la imagen (tamaño recomendado: 1200x630px)</small>
                                </div>
                            </div>
                            <div class="servicio-col-6">
                                <div class="servicio-form-group">
                                    <label for="og_type" class="servicio-label">Tipo OG</label>
                                    <select class="servicio-select" id="og_type" name="og_type">
                                        <option value="website" {{ (old('og_type', $editSeo->og_type ?? '') == 'website') ? 'selected' : '' }}>website</option>
                                        <option value="article" {{ (old('og_type', $editSeo->og_type ?? '') == 'article') ? 'selected' : '' }}>article</option>
                                        <option value="blog" {{ (old('og_type', $editSeo->og_type ?? '') == 'blog') ? 'selected' : '' }}>blog</option>
                                        <option value="product" {{ (old('og_type', $editSeo->og_type ?? '') == 'product') ? 'selected' : '' }}>product</option>
                                    </select>
                                </div>
                            </div>
                            <div class="servicio-col-6">
                                <div class="servicio-form-group">
                                    <label for="og_locale" class="servicio-label">Locale OG</label>
                                    <select class="servicio-select" id="og_locale" name="og_locale">
                                        <option value="es_CO" {{ (old('og_locale', $editSeo->og_locale ?? '') == 'es_CO') ? 'selected' : '' }}>es_CO</option>
                                        <option value="es_ES" {{ (old('og_locale', $editSeo->og_locale ?? '') == 'es_ES') ? 'selected' : '' }}>es_ES</option>
                                        <option value="en_US" {{ (old('og_locale', $editSeo->og_locale ?? '') == 'en_US') ? 'selected' : '' }}>en_US</option>
                                    </select>
                                </div>
                            </div>
                            <div class="servicio-col-6">
                                <div class="servicio-form-group">
                                    <label for="og_site_name" class="servicio-label">Nombre del sitio OG</label>
                                    <input type="text" class="servicio-input" id="og_site_name" name="og_site_name"
                                        value="{{ old('og_site_name', $editSeo->og_site_name ?? '') }}"
                                        placeholder="DevCloud">
                                </div>
                            </div>
                            <div class="servicio-col-6">
                                <div class="servicio-form-group">
                                    <label for="og_url" class="servicio-label">URL OG</label>
                                    <input type="url" class="servicio-input" id="og_url" name="og_url"
                                        value="{{ old('og_url', $editSeo->og_url ?? '') }}"
                                        placeholder="https://devcloud.com/pagina">
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Pestaña: Twitter Card -->
                    <div class="tab-pane fade" id="twitter-content" role="tabpanel">
                        <div class="servicio-row">
                            <div class="servicio-col-6">
                                <div class="servicio-form-group">
                                    <label for="twitter_card" class="servicio-label">Twitter Card</label>
                                    <select class="servicio-select" id="twitter_card" name="twitter_card">
                                        <option value="summary_large_image" {{ (old('twitter_card', $editSeo->twitter_card ?? '') == 'summary_large_image') ? 'selected' : '' }}>summary_large_image</option>
                                        <option value="summary" {{ (old('twitter_card', $editSeo->twitter_card ?? '') == 'summary') ? 'selected' : '' }}>summary</option>
                                        <option value="player" {{ (old('twitter_card', $editSeo->twitter_card ?? '') == 'player') ? 'selected' : '' }}>player</option>
                                        <option value="app" {{ (old('twitter_card', $editSeo->twitter_card ?? '') == 'app') ? 'selected' : '' }}>app</option>
                                    </select>
                                </div>
                            </div>
                            <div class="servicio-col-12">
                                <div class="servicio-form-group">
                                    <label for="twitter_title" class="servicio-label">Título Twitter</label>
                                    <input type="text" class="servicio-input" id="twitter_title" name="twitter_title"
                                        value="{{ old('twitter_title', $editSeo->twitter_title ?? '') }}"
                                        placeholder="Título para compartir en Twitter">
                                </div>
                            </div>
                            <div class="servicio-col-12">
                                <div class="servicio-form-group">
                                    <label for="twitter_description" class="servicio-label">Descripción Twitter</label>
                                    <textarea class="servicio-textarea" id="twitter_description" name="twitter_description"
                                        rows="3" placeholder="Descripción para compartir en Twitter">{{ old('twitter_description', $editSeo->twitter_description ?? '') }}</textarea>
                                </div>
                            </div>
                            <div class="servicio-col-12">
                                <div class="servicio-form-group">
                                    <label for="twitter_image" class="servicio-label">Imagen Twitter</label>
                                    <input type="url" class="servicio-input" id="twitter_image" name="twitter_image"
                                        value="{{ old('twitter_image', $editSeo->twitter_image ?? '') }}"
                                        placeholder="https://devcloud.com/images/twitter-image.jpg">
                                </div>
                            </div>
                            <div class="servicio-col-6">
                                <div class="servicio-form-group">
                                    <label for="twitter_image_alt" class="servicio-label">Alt de la imagen Twitter</label>
                                    <input type="text" class="servicio-input" id="twitter_image_alt" name="twitter_image_alt"
                                        value="{{ old('twitter_image_alt', $editSeo->twitter_image_alt ?? '') }}"
                                        placeholder="Descripción de la imagen">
                                </div>
                            </div>
                            <div class="servicio-col-6">
                                <div class="servicio-form-group">
                                    <label for="twitter_site" class="servicio-label">Cuenta Twitter (sitio)</label>
                                    <input type="text" class="servicio-input" id="twitter_site" name="twitter_site"
                                        value="{{ old('twitter_site', $editSeo->twitter_site ?? '') }}"
                                        placeholder="@devcloud">
                                </div>
                            </div>
                            <div class="servicio-col-6">
                                <div class="servicio-form-group">
                                    <label for="twitter_creator" class="servicio-label">Cuenta Twitter (creador)</label>
                                    <input type="text" class="servicio-input" id="twitter_creator" name="twitter_creator"
                                        value="{{ old('twitter_creator', $editSeo->twitter_creator ?? '') }}"
                                        placeholder="@usuario">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="servicio-d-flex servicio-justify-between servicio-my-3">
                    <a href="{{ route('admin.seo.index') }}" class="servicio-btn servicio-btn-secondary">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-lienjoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                        </svg>
                        Volver
                    </a>
                    <button type="submit" class="servicio-btn servicio-btn-primary">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                        </svg>
                        Crear SEO
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Pestaña: Editar SEO -->
    @if(isset($editSeo))
    <div class="servicio-tab-pane tab-pane active show"
        id="editar-tab-pane" role="tabpanel" aria-labelledby="editar-tab" tabindex="0">
        <div class="servicio-card-body">
            <form action="{{ route('admin.seo.update', $editSeo->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="servicio-row">
                    <div class="servicio-col-12">
                        <div class="servicio-form-group">
                            <label for="page_slug" class="servicio-label">Slug de la página <span class="text-danger">*</span></label>
                            <input type="text" class="servicio-input" id="page_slug" name="page_slug"
                                value="{{ $editSeo->page_slug }}"
                                placeholder="home, servicios, nosotros, etc." required readonly>
                            <small class="servicio-helper-text">Identificador único para la página (no se puede editar)</small>
                        </div>
                    </div>
                </div>
 <!-- Sección: Básico -->
 <h3>Básico</h3>
        <div class="servicio-row">
            <div class="servicio-col-12">
                <div class="servicio-form-group">
                    <label for="meta_title" class="servicio-label">Título</label>
                    <input type="text" class="servicio-input" id="meta_title" name="meta_title"
                        value="{{ old('meta_title', $editSeo->meta_title ?? '') }}"
                        placeholder="Título de la página" maxlength="60">
                    <small class="servicio-helper-text">Recomendado: 50-60 caracteres</small>
                </div>
            </div>
            <div class="servicio-col-12">
                <div class="servicio-form-group">
                    <label for="meta_description" class="servicio-label">Descripción</label>
                    <textarea class="servicio-textarea" id="meta_description" name="meta_description"
                        rows="3" maxlength="160" placeholder="Descripción breve de la página">{{ old('meta_description', $editSeo->meta_description ?? '') }}</textarea>
                    <small class="servicio-helper-text">Recomendado: 150-160 caracteres</small>
                </div>
            </div>
            <div class="servicio-col-12">
                <div class="servicio-form-group">
                    <label for="meta_keywords" class="servicio-label">Palabras clave</label>
                    <textarea class="servicio-textarea" id="meta_keywords" name="meta_keywords"
                        rows="2" placeholder="palabra1, palabra2, palabra3">{{ old('meta_keywords', $editSeo->meta_keywords ?? '') }}</textarea>
                </div>
            </div>
            <div class="servicio-col-6">
                <div class="servicio-form-group">
                    <label for="meta_robots" class="servicio-label">Robots</label>
                    <select class="servicio-select" id="meta_robots" name="meta_robots">
                        <option value="index, follow" {{ (old('meta_robots', $editSeo->meta_robots ?? '') == 'index, follow') ? 'selected' : '' }}>index, follow</option>
                        <option value="index, nofollow" {{ (old('meta_robots', $editSeo->meta_robots ?? '') == 'index, nofollow') ? 'selected' : '' }}>index, nofollow</option>
                        <option value="noindex, follow" {{ (old('meta_robots', $editSeo->meta_robots ?? '') == 'noindex, follow') ? 'selected' : '' }}>noindex, follow</option>
                        <option value="noindex, nofollow" {{ (old('meta_robots', $editSeo->meta_robots ?? '') == 'noindex, nofollow') ? 'selected' : '' }}>noindex, nofollow</option>
                    </select>
                </div>
            </div>
            <div class="servicio-col-6">
                <div class="servicio-form-group">
                    <label for="canonical_url" class="servicio-label">URL Canónica</label>
                    <input type="url" class="servicio-input" id="canonical_url" name="canonical_url"
                        value="{{ old('canonical_url', $editSeo->canonical_url ?? '') }}"
                        placeholder="https://devcloud.com/pagina">
                </div>
            </div>
            <div class="servicio-col-6">
                <div class="servicio-form-group">
                    <label for="language_code" class="servicio-label">Idioma</label>
                    <select class="servicio-select" id="language_code" name="language_code">
                        <option value="es" {{ (old('language_code', $editSeo->language_code ?? '') == 'es') ? 'selected' : '' }}>Español (es)</option>
                        <option value="en" {{ (old('language_code', $editSeo->language_code ?? '') == 'en') ? 'selected' : '' }}>Inglés (en)</option>
                        <option value="es-ES" {{ (old('language_code', $editSeo->language_code ?? '') == 'es-ES') ? 'selected' : '' }}>Español de España (es-ES)</option>
                        <option value="es-CO" {{ (old('language_code', $editSeo->language_code ?? '') == 'es-CO') ? 'selected' : '' }}>Español de Colombia (es-CO)</option>
                    </select>
                </div>
            </div>
        </div>

        <!-- Sección: Open Graph -->
        <h3>Open Graph</h3>
        <div class="servicio-row">
            <div class="servicio-col-12">
                <div class="servicio-form-group">
                    <label for="og_title" class="servicio-label">Título OG</label>
                    <input type="text" class="servicio-input" id="og_title" name="og_title"
                        value="{{ old('og_title', $editSeo->og_title ?? '') }}"
                        placeholder="Título para compartir en redes sociales">
                </div>
            </div>
            <div class="servicio-col-12">
                <div class="servicio-form-group">
                    <label for="og_description" class="servicio-label">Descripción OG</label>
                    <textarea class="servicio-textarea" id="og_description" name="og_description"
                        rows="3" placeholder="Descripción para compartir en redes sociales">{{ old('og_description', $editSeo->og_description ?? '') }}</textarea>
                </div>
            </div>
            <div class="servicio-col-12">
                <div class="servicio-form-group">
                    <label for="og_image" class="servicio-label">Imagen OG</label>
                    <input type="url" class="servicio-input" id="og_image" name="og_image"
                        value="{{ old('og_image', $editSeo->og_image ?? '') }}"
                        placeholder="https://devcloud.com/images/og-image.jpg">
                    <small class="servicio-helper-text">URL completa a la imagen (tamaño recomendado: 1200x630px)</small>
                </div>
            </div>
            <div class="servicio-col-6">
                <div class="servicio-form-group">
                    <label for="og_type" class="servicio-label">Tipo OG</label>
                    <select class="servicio-select" id="og_type" name="og_type">
                        <option value="website" {{ (old('og_type', $editSeo->og_type ?? '') == 'website') ? 'selected' : '' }}>website</option>
                        <option value="article" {{ (old('og_type', $editSeo->og_type ?? '') == 'article') ? 'selected' : '' }}>article</option>
                        <option value="blog" {{ (old('og_type', $editSeo->og_type ?? '') == 'blog') ? 'selected' : '' }}>blog</option>
                        <option value="product" {{ (old('og_type', $editSeo->og_type ?? '') == 'product') ? 'selected' : '' }}>product</option>
                    </select>
                </div>
            </div>
            <div class="servicio-col-6">
                <div class="servicio-form-group">
                    <label for="og_locale" class="servicio-label">Locale OG</label>
                    <select class="servicio-select" id="og_locale" name="og_locale">
                        <option value="es_CO" {{ (old('og_locale', $editSeo->og_locale ?? '') == 'es_CO') ? 'selected' : '' }}>es_CO</option>
                        <option value="es_ES" {{ (old('og_locale', $editSeo->og_locale ?? '') == 'es_ES') ? 'selected' : '' }}>es_ES</option>
                        <option value="en_US" {{ (old('og_locale', $editSeo->og_locale ?? '') == 'en_US') ? 'selected' : '' }}>en_US</option>
                    </select>
                </div>
            </div>
            <div class="servicio-col-6">
                <div class="servicio-form-group">
                    <label for="og_site_name" class="servicio-label">Nombre del sitio OG</label>
                    <input type="text" class="servicio-input" id="og_site_name" name="og_site_name"
                        value="{{ old('og_site_name', $editSeo->og_site_name ?? '') }}"
                        placeholder="DevCloud">
                </div>
            </div>
            <div class="servicio-col-6">
                <div class="servicio-form-group">
                    <label for="og_url" class="servicio-label">URL OG</label>
                    <input type="url" class="servicio-input" id="og_url" name="og_url"
                        value="{{ old('og_url', $editSeo->og_url ?? '') }}"
                        placeholder="https://devcloud.com/pagina">
                </div>
            </div>
        </div>

        <!-- Sección: Twitter Card -->
        <h3>Twitter Card</h3>
        <div class="servicio-row">
            <div class="servicio-col-6">
                <div class="servicio-form-group">
                    <label for="twitter_card" class="servicio-label">Twitter Card</label>
                    <select class="servicio-select" id="twitter_card" name="twitter_card">
                        <option value="summary_large_image" {{ (old('twitter_card', $editSeo->twitter_card ?? '') == 'summary_large_image') ? 'selected' : '' }}>summary_large_image</option>
                        <option value="summary" {{ (old('twitter_card', $editSeo->twitter_card ?? '') == 'summary') ? 'selected' : '' }}>summary</option>
                        <option value="player" {{ (old('twitter_card', $editSeo->twitter_card ?? '') == 'player') ? 'selected' : '' }}>player</option>
                        <option value="app" {{ (old('twitter_card', $editSeo->twitter_card ?? '') == 'app') ? 'selected' : '' }}>app</option>
                    </select>
                </div>
            </div>
            <div class="servicio-col-12">
                <div class="servicio-form-group">
                    <label for="twitter_title" class="servicio-label">Título Twitter</label>
                    <input type="text" class="servicio-input" id="twitter_title" name="twitter_title"
                        value="{{ old('twitter_title', $editSeo->twitter_title ?? '') }}"
                        placeholder="Título para compartir en Twitter">
                </div>
            </div>
            <div class="servicio-col-12">
                <div class="servicio-form-group">
                    <label for="twitter_description" class="servicio-label">Descripción Twitter</label>
                    <textarea class="servicio-textarea" id="twitter_description" name="twitter_description"
                        rows="3" placeholder="Descripción para compartir en Twitter">{{ old('twitter_description', $editSeo->twitter_description ?? '') }}</textarea>
                </div>
            </div>
            <div class="servicio-col-12">
                <div class="servicio-form-group">
                    <label for="twitter_image" class="servicio-label">Imagen Twitter</label>
                    <input type="url" class="servicio-input" id="twitter_image" name="twitter_image"
                        value="{{ old('twitter_image', $editSeo->twitter_image ?? '') }}"
                        placeholder="https://devcloud.com/images/twitter-image.jpg">
                </div>
            </div>
            <div class="servicio-col-6">
                <div class="servicio-form-group">
                    <label for="twitter_image_alt" class="servicio-label">Alt de la imagen Twitter</label>
                    <input type="text" class="servicio-input" id="twitter_image_alt" name="twitter_image_alt"
                        value="{{ old('twitter_image_alt', $editSeo->twitter_image_alt ?? '') }}"
                        placeholder="Descripción de la imagen">
                </div>
            </div>
            <div class="servicio-col-6">
                <div class="servicio-form-group">
                    <label for="twitter_site" class="servicio-label">Cuenta Twitter (sitio)</label>
                    <input type="text" class="servicio-input" id="twitter_site" name="twitter_site"
                        value="{{ old('twitter_site', $editSeo->twitter_site ?? '') }}"
                        placeholder="@devcloud">
                </div>
            </div>
            <div class="servicio-col-6">
                <div class="servicio-form-group">
                    <label for="twitter_creator" class="servicio-label">Cuenta Twitter (creador)</label>
                    <input type="text" class="servicio-input" id="twitter_creator" name="twitter_creator"
                        value="{{ old('twitter_creator', $editSeo->twitter_creator ?? '') }}"
                        placeholder="@usuario">
                </div>
            </div>
        </div>

        <!-- Botones de acción -->
        <div class="servicio-d-flex servicio-justify-between servicio-my-3">
            <a href="{{ route('admin.seo.index') }}" class="servicio-btn servicio-btn-secondary">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                </svg>
                Volver
            </a>
            <button type="submit" class="servicio-btn servicio-btn-primary">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                    xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                </svg>
                Guardar cambios
            </button>
        </div>
    </form>
</div>
@endif

    @endsection
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Inicialización de DataTables
            if (document.getElementById('seo_dataTable')) {
                $('#seo_dataTable').DataTable({
                    language: {
                        url: 'https://cdn.datatables.net/plug-ins/1.13.7/i18n/es-ES.json'
                    },
                    order: [
                        [0, 'desc']
                    ]
                });
            }

            // Autocompletar campos
            const metaTitleInput = document.getElementById('meta_title');
            const ogTitleInput = document.getElementById('og_title');
            const twitterTitleInput = document.getElementById('twitter_title');

            const metaDescriptionInput = document.getElementById('meta_description');
            const ogDescriptionInput = document.getElementById('og_description');
            const twitterDescriptionInput = document.getElementById('twitter_description');

            // Función para autocompletar títulos
            if (metaTitleInput) {
                metaTitleInput.addEventListener('blur', function() {
                    if (ogTitleInput && !ogTitleInput.value.trim()) {
                        ogTitleInput.value = this.value;
                    }

                    if (twitterTitleInput && !twitterTitleInput.value.trim()) {
                        twitterTitleInput.value = this.value;
                    }
                });
            }

            // Función para autocompletar descripciones
            if (metaDescriptionInput) {
                metaDescriptionInput.addEventListener('blur', function() {
                    if (ogDescriptionInput && !ogDescriptionInput.value.trim()) {
                        ogDescriptionInput.value = this.value;
                    }

                    if (twitterDescriptionInput && !twitterDescriptionInput.value.trim()) {
                        twitterDescriptionInput.value = this.value;
                    }
                });
            }

            // Confirmación de eliminación
            const deleteForms = document.querySelectorAll('.delete-form');
            deleteForms.forEach(form => {
                form.addEventListener('submit', function(e) {
                    if (!confirm('¿Estás seguro de eliminar este registro de SEO?')) {
                        e.preventDefault();
                    }
                });
            });

            // Validación de slug
            const pageSlugInput = document.getElementById('page_slug');
            if (pageSlugInput) {
                pageSlugInput.addEventListener('input', function() {
                    // Convertir a minúsculas y reemplazar espacios con guiones
                    this.value = this.value
                        .toLowerCase()
                        .replace(/\s+/g, '-')
                        .replace(/[^a-z0-9-]/g, '');
                });
            }

            // Contador de caracteres para título y descripción
            const characterCounters = [{
                    input: 'meta_title',
                    counter: 'meta_title_counter',
                    max: 60
                },
                {
                    input: 'meta_description',
                    counter: 'meta_description_counter',
                    max: 160
                }
            ];

            characterCounters.forEach(item => {
                const input = document.getElementById(item.input);
                const counterSpan = document.getElementById(item.counter);

                if (input && counterSpan) {
                    input.addEventListener('input', function() {
                        const remaining = item.max - this.value.length;
                        counterSpan.textContent = `${remaining} caracteres restantes`;

                        if (remaining < 0) {
                            counterSpan.classList.add('text-danger');
                        } else {
                            counterSpan.classList.remove('text-danger');
                        }
                    });
                }
            });
        });
    </script>