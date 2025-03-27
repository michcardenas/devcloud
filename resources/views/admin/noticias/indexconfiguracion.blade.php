@extends('layouts.admin')

@section('content')
<div class="servicio-container">
    <h1 class="servicio-title">Configuración de Noticias</h1>
    
    <ul class="servicio-breadcrumb">
        <li class="servicio-breadcrumb-item">
            <a href="{{ route('dashboard') }}" class="servicio-breadcrumb-link">Dashboard</a>
        </li>
        <li class="servicio-breadcrumb-item">
            <span class="servicio-breadcrumb-active">Configuración</span>
        </li>
    </ul>

    <ul class="servicio-tabs">
        <li class="servicio-tab-item">
            <a href="{{ route('admin.noticias.index') }}" class="servicio-tab-link">
                <span class="servicio-tab-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                </span>
                Listado
            </a>
        </li>
        <li class="servicio-tab-item">
            <a href="{{ route('admin.categorias.index') }}" class="servicio-tab-link">
                <span class="servicio-tab-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path>
                        <line x1="7" y1="7" x2="7.01" y2="7"></line>
                    </svg>
                </span>
                Categorías
            </a>
        </li>
        <li class="servicio-tab-item">
        <a href="{{ route('admin.configuracion-noticias.edit') }}" class="servicio-tab-link active">
                <span class="servicio-tab-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M12 20h9"></path>
                        <path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"></path>
                    </svg>
                </span>
                Configuración
            </a>
        </li>
    </ul>

    <div class="servicio-tab-content">
        <div class="servicio-tab-pane active">
            @if(session('success'))
            <div class="servicio-alert servicio-alert-success">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 10px;">
                    <path d="M22 11.08V12a10 10 0 1 1-5.93-9.14"></path>
                    <polyline points="22 4 12 14.01 9 11.01"></polyline>
                </svg>
                {{ session('success') }}
            </div>
            @endif

            @if(session('error'))
            <div class="servicio-alert servicio-alert-danger">
                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="margin-right: 10px;">
                    <circle cx="12" cy="12" r="10"></circle>
                    <line x1="12" y1="8" x2="12" y2="12"></line>
                    <line x1="12" y1="16" x2="12.01" y2="16"></line>
                </svg>
                {{ session('error') }}
            </div>
            @endif

            <div class="servicio-card">
                <div class="servicio-card-header">
                    <h2 class="servicio-card-title">Configuración General</h2>
                </div>
                <div class="servicio-card-body">
                <form action="{{ route('admin.configuracion-noticias.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="servicio-form-group">
                            <label for="titulo_seccion" class="servicio-label">Título de la Sección <span class="servicio-text-danger">*</span></label>
                            <input type="text" id="titulo_seccion" name="titulo_seccion" class="servicio-input" 
                                   value="{{ $configuracion->titulo_seccion ?? 'Noticias y Eventos' }}" required maxlength="255">
                            <span class="servicio-helper-text">Título que aparecerá en la sección de noticias del sitio web</span>
                        </div>
                        
                        <div class="servicio-form-group">
                            <label for="etiqueta" class="servicio-label">Etiqueta <span class="servicio-text-danger">*</span></label>
                            <input type="text" id="etiqueta" name="etiqueta" class="servicio-input" 
                                   value="{{ $configuracion->etiqueta ?? 'Últimas Actualizaciones' }}" required maxlength="255">
                            <span class="servicio-helper-text">Etiqueta o subtítulo de la sección de noticias</span>
                        </div>
                        
                        <div class="servicio-form-group">
                            <label for="descripcion" class="servicio-label">Descripción <span class="servicio-text-danger">*</span></label>
                            <textarea id="descripcion" name="descripcion" class="servicio-textarea" rows="5" required>{{ $configuracion->descripcion ?? 'Mantente informado con nuestras últimas noticias y eventos. Descubre las novedades más recientes y no te pierdas ninguna actualización importante.' }}</textarea>
                            <span class="servicio-helper-text">Breve descripción que aparecerá debajo del título de la sección</span>
                        </div>
                        
                        <div class="servicio-form-group">
                            <label for="items_por_pagina" class="servicio-label">Noticias por Página</label>
                            <select id="items_por_pagina" name="items_por_pagina" class="servicio-select">
                                @foreach([6, 9, 12, 15, 18, 21] as $num)
                                    <option value="{{ $num }}" {{ ($configuracion->items_por_pagina ?? 9) == $num ? 'selected' : '' }}>{{ $num }}</option>
                                @endforeach
                            </select>
                            <span class="servicio-helper-text">Número de noticias a mostrar por página en el listado público</span>
                        </div>
                        
                        <div class="servicio-checkbox-container">
                            <div class="servicio-switch">
                                <input type="checkbox" id="mostrar_destacadas" name="mostrar_destacadas" class="servicio-switch-input" 
                                       {{ ($configuracion->mostrar_destacadas ?? true) ? 'checked' : '' }}>
                                <span class="servicio-switch-slider"></span>
                            </div>
                            <label for="mostrar_destacadas" class="servicio-label" style="margin-bottom: 0;">Mostrar noticias destacadas en la página principal</label>
                        </div>
                        
                        <div class="servicio-form-group" style="margin-top: 1rem;">
                            <label for="cantidad_destacadas" class="servicio-label">Cantidad de Noticias Destacadas</label>
                            <select id="cantidad_destacadas" name="cantidad_destacadas" class="servicio-select">
                                @foreach([3, 4, 5, 6] as $num)
                                    <option value="{{ $num }}" {{ ($configuracion->cantidad_destacadas ?? 3) == $num ? 'selected' : '' }}>{{ $num }}</option>
                                @endforeach
                            </select>
                            <span class="servicio-helper-text">Número de noticias destacadas a mostrar en la página principal</span>
                        </div>
                        
                        <div class="servicio-d-flex servicio-justify-end" style="margin-top: 2rem;">
                            <button type="submit" class="servicio-btn servicio-btn-primary">
                                <span class="servicio-btn-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <path d="M19 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11l5 5v11a2 2 0 0 1-2 2z"></path>
                                        <polyline points="17 21 17 13 7 13 7 21"></polyline>
                                        <polyline points="7 3 7 8 15 8"></polyline>
                                    </svg>
                                </span>
                                Guardar Configuración
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            
            <div class="servicio-card" style="margin-top: 1.5rem;">
                <div class="servicio-card-header">
                    <h2 class="servicio-card-title">Vista Previa de la Sección</h2>
                </div>
                <div class="servicio-card-body">
                    <div class="preview-section" style="background-color: #f5f5f5; padding: 2rem; border-radius: 0.5rem;">
                        <h3 style="font-size: 0.8rem; color: #6b7280; margin-bottom: 0.5rem;">{{ $configuracion->etiqueta ?? 'Últimas Actualizaciones' }}</h3>
                        <h2 style="font-size: 1.5rem; font-weight: 600; margin-bottom: 1rem;">{{ $configuracion->titulo_seccion ?? 'Noticias y Eventos' }}</h2>
                        <p style="color: #4b5563; margin-bottom: 2rem;">{{ $configuracion->descripcion ?? 'Mantente informado con nuestras últimas noticias y eventos. Descubre las novedades más recientes y no te pierdas ninguna actualización importante.' }}</p>
                        
                        <div style="display: grid; grid-template-columns: repeat(auto-fill, minmax(280px, 1fr)); gap: 1.5rem;">
                            @for ($i = 0; $i < 3; $i++)
                            <div style="background-color: white; border-radius: 0.5rem; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1);">
                                <div style="height: 160px; background-color: #e2e8f0; display: flex; align-items: center; justify-content: center;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="#94a3b8" stroke-width="1" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                        <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                        <polyline points="21 15 16 10 5 21"></polyline>
                                    </svg>
                                </div>
                                <div style="padding: 1rem;">
                                    <span style="font-size: 0.75rem; color: #6b7280;">Categoría</span>
                                    <h3 style="font-size: 1.125rem; font-weight: 600; margin: 0.5rem 0;">Título de la noticia ejemplo</h3>
                                    <p style="font-size: 0.875rem; color: #4b5563; margin-bottom: 1rem;">Descripción breve de la noticia para mostrar como ejemplo en la vista previa...</p>
                                    <div style="display: flex; justify-content: space-between; align-items: center;">
                                        <span style="font-size: 0.75rem; color: #6b7280;">{{ date('d/m/Y') }}</span>
                                        <a href="#" style="font-size: 0.875rem; color: #2563eb; text-decoration: none;">Leer más →</a>
                                    </div>
                                </div>
                            </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Vista previa en tiempo real
    const tituloSeccion = document.getElementById('titulo_seccion');
    const etiqueta = document.getElementById('etiqueta');
    const descripcion = document.getElementById('descripcion');
    
    const previewTitulo = document.querySelector('.preview-section h2');
    const previewEtiqueta = document.querySelector('.preview-section h3');
    const previewDescripcion = document.querySelector('.preview-section p');
    
    if (tituloSeccion && previewTitulo) {
        tituloSeccion.addEventListener('input', function() {
            previewTitulo.textContent = this.value || 'Noticias y Eventos';
        });
    }
    
    if (etiqueta && previewEtiqueta) {
        etiqueta.addEventListener('input', function() {
            previewEtiqueta.textContent = this.value || 'Últimas Actualizaciones';
        });
    }
    
    if (descripcion && previewDescripcion) {
        descripcion.addEventListener('input', function() {
            previewDescripcion.textContent = this.value || 'Mantente informado con nuestras últimas noticias y eventos...';
        });
    }
    
    // Mostrar/ocultar cantidad de destacadas según el estado del switch
    const mostrarDestacadas = document.getElementById('mostrar_destacadas');
    const cantidadDestacadasGroup = document.getElementById('cantidad_destacadas').closest('.servicio-form-group');
    
    if (mostrarDestacadas && cantidadDestacadasGroup) {
        function toggleCantidadDestacadas() {
            cantidadDestacadasGroup.style.display = mostrarDestacadas.checked ? 'block' : 'none';
        }
        
        // Ejecutar al cargar la página
        toggleCantidadDestacadas();
        
        // Ejecutar cuando cambie el switch
        mostrarDestacadas.addEventListener('change', toggleCantidadDestacadas);
    }
});
</script>
@endsection