@extends('layouts.admin')

@section('content')
<section class="container py-5 text-white">
    <h2 class="mb-4">Gestión de la Página de Servicios</h2>
    @if (session('success'))
    <div class="alert alert-success text-center">
        {{ session('success') }}
    </div>
@endif

<form action="{{ route('admin.servicios_page.store') }}" method="POST" enctype="multipart/form-data">
    @csrf

    <!-- BLOQUE PRINCIPAL -->
 <!-- BLOQUE PRINCIPAL -->
    <div class="p-4 mb-4 rounded shadow bg-dark text-white border border-secondary">
        <h4 class="mb-3">🧱 Bloque Principal</h4>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label text-light">Tagline</label>
                <input type="text" name="tagline" class="form-control bg-dark text-white border-secondary" value="{{ old('tagline', $serviciosPage->tagline ?? '') }}">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label text-light">Título H1</label>
                <input type="text" name="titulo_h1" class="form-control bg-dark text-white border-secondary" value="{{ old('titulo_h1', $serviciosPage->titulo_h1 ?? '') }}">
            </div>
            <div class="col-12 mb-3">
                <label class="form-label text-light">Contenido principal (Párrafo)</label>
                <textarea name="p_contenido" rows="4" class="form-control bg-dark text-white border-secondary">{{ old('p_contenido', $serviciosPage->p_contenido ?? '') }}</textarea>
            </div>
        </div>
    </div>

<!-- BLOQUE 2 -->
    <div class="p-4 mb-4 rounded shadow bg-dark text-white border border-secondary">
        <h4 class="mb-3">🧱 Bloque 2</h4>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label text-light">Tagline 2</label>
                <input type="text" name="tagline2" class="form-control bg-dark text-white border-secondary" value="{{ old('tagline2', $serviciosPage->tagline2 ?? '') }}">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label text-light">Subtítulo H2</label>
                <input type="text" name="sub_h2" class="form-control bg-dark text-white border-secondary" value="{{ old('sub_h2', $serviciosPage->sub_h2 ?? '') }}">
            </div>
            <div class="col-12 mb-3">
                <label class="form-label text-light">Contenido 2</label>
                <textarea name="contenido_2" rows="4" class="form-control bg-dark text-white border-secondary">{{ old('contenido_2', $serviciosPage->contenido_2 ?? '') }}</textarea>
            </div>
        </div>
    </div>


<!-- BLOQUE 3 -->
    @for ($bloque = 1; $bloque <= 3; $bloque++)
    @php
    $taglineField = "tagline" . ($bloque + 2); // tagline3, tagline5, tagline6
        $imagenField = "imagen" . $bloque;         // imagen1, imagen2, imagen3
        $subField = "sub" . ($bloque + 1) . "_h2"; // sub2_h2, sub4_h2, sub5_h2
        $contenidoField = "contenido_" . ($bloque + 2); // contenido_3, contenido_5, contenido_6
        @endphp

    <div class="p-4 mb-4 rounded shadow bg-dark text-white border border-secondary">
        <h4 class="mb-3">🧱 Bloque {{ $bloque }}</h4>
        <div class="row">
            {{-- Tagline --}}
            <div class="col-md-6 mb-3">
                <label class="form-label text-light">Tagline {{ $bloque + 2 }}</label>
                <input type="text" name="{{ $taglineField }}" class="form-control bg-dark text-white border-secondary"
                    value="{{ old($taglineField, $serviciosPage->{$taglineField} ?? '') }}">
            </div>

            {{-- Imagen Principal --}}
            <div class="col-md-6 mb-3">
                <label class="form-label text-light">Imagen principal del bloque {{ $bloque }}</label><br>
                @if (isset($serviciosPage) && !empty($serviciosPage->{$imagenField}))
                <img src="{{ asset($serviciosPage->{$imagenField} ?? '') }}" class="img-thumbnail mb-2" style="max-height: 100px;">
                @endif
                <input type="file" name="imagen{{ $bloque }}" class="form-control bg-dark text-white border-secondary">
                </div>

            {{-- Sub H2 --}}
            <div class="col-md-6 mb-3">
                <label class="form-label text-light">Sub {{ $bloque + 1 }} H2</label>
                <input type="text" name="{{ $subField }}" class="form-control bg-dark text-white border-secondary"
                    value="{{ old($subField, $serviciosPage->{$subField} ?? '') }}">
            </div>

            {{-- Contenido --}}
            <div class="col-md-6 mb-3">
                <label class="form-label text-light">Contenido</label>
                <textarea name="{{ $contenidoField }}" rows="4" class="form-control bg-dark text-white border-secondary">{{ old($contenidoField, $serviciosPage->{$contenidoField} ?? '') }}</textarea>
            </div>
        </div>
   

        {{-- Atributos del bloque --}}
        <div class="row">
            @for ($i = 1; $i <= 4; $i++)
                @php
                    $tituloAttr = "titulo_atributo{$i}_{$bloque}";
                    $contenidoAttr = "contenido_atributo{$i}_{$bloque}";
                    $imagenAttr = "imagen_atributo{$i}_{$bloque}";
                @endphp

                <div class="col-md-6 mb-4">
                    <div class="border p-3 rounded bg-dark text-white border-secondary">
                        <h6 class="mb-3">Atributo {{ $i }}</h6>

                        <div class="mb-2">
                            <label class="form-label text-light">Título</label>
                            <input type="text" name="{{ $tituloAttr }}" class="form-control bg-dark text-white border-secondary"
                                value="{{ old($tituloAttr, $serviciosPage->{$tituloAttr} ?? '') }}">
                        </div>

                        <div class="mb-2">
                            <label class="form-label text-light">Contenido</label>
                            <textarea name="{{ $contenidoAttr }}" rows="2" class="form-control bg-dark text-white border-secondary">{{ old($contenidoAttr, $serviciosPage->{$contenidoAttr} ?? '') }}</textarea>
                        </div>

                        <div class="mb-2">
                            <label class="form-label text-light">Imagen (opcional)</label><br>
                            @if (isset($serviciosPage) && !empty($serviciosPage->{$imagenAttr}))
                            <img src="{{ asset($serviciosPage->{$imagenAttr}) }}" class="img-thumbnail mb-2" style="max-height: 100px;">
                            @endif

                            {{-- Input file para subir imagen nueva --}}
                            <input type="file" name="{{ $imagenAttr }}" class="form-control bg-dark text-white border-secondary">

                            {{-- Input hidden para conservar imagen actual --}}
                            <input type="hidden" name="old_{{ $imagenAttr }}" value="{{ $serviciosPage->{$imagenAttr} ?? '' }}">
                            </div>

                    </div>
                </div>
            @endfor
        </div>
    </div>
    @endfor

    <!-- BLOQUE FINAL -->
    <div class="p-4 mb-4 rounded shadow bg-dark text-white border border-secondary">
        <h4 class="mb-3">🚀 Bloque Final</h4>
        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label text-light">Sub 3 H2</label>
                <input type="text" name="sub3_h2" class="form-control bg-dark text-white border-secondary" value="{{ old('sub3_h2', $serviciosPage->sub3_h2 ?? '') }}">
            </div>
            <div class="col-md-6 mb-3">
                <label class="form-label text-light">Contenido 4</label>
                <textarea name="contenido_4" rows="4" class="form-control bg-dark text-white border-secondary">{{ old('contenido_4', $serviciosPage->contenido_4 ?? '') }}</textarea>
            </div>
        </div>
    </div>

    <div class="text-end">
        <button type="submit" class="btn btn-outline-light px-4">💾 Guardar</button>
    </div>
</form>


</section>

<div class="servicio-container">
    <h1 class="servicio-title">Gestión de Servicios</h1>


    @if (session('success'))
        <div class="servicio-alert servicio-alert-success">
            <span class="servicio-alert-icon">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                </svg>
            </span>
            {{ session('success') }}
            <button type="button" class="servicio-alert-close" data-bs-dismiss="alert" aria-label="Close">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    @endif

    @if ($errors->any())
        <div class="servicio-alert servicio-alert-danger">
            <span class="servicio-alert-icon">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"></path>
                </svg>
            </span>
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="servicio-alert-close" data-bs-dismiss="alert" aria-label="Close">
                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                </svg>
            </button>
        </div>
    @endif

    <!-- Pestañas de navegación -->
    <ul class="servicio-tabs" role="tablist">
        <li class="servicio-tab-item" role="presentation">
            <button class="servicio-tab-link active" id="lista-tab" data-bs-toggle="tab" data-bs-target="#lista-tab-pane" 
                type="button" role="tab" aria-controls="lista-tab-pane" aria-selected="true">
                <span class="servicio-tab-icon">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                    </svg>
                </span>
                Listado
            </button>
        </li>
        <!-- Agregar esto a la lista de pestañas pero mantenerlo oculto -->
<li class="servicio-tab-item" role="presentation" style="display: none;">
    <button class="servicio-tab-link" id="nueva-caracteristica-tab" data-bs-toggle="tab" data-bs-target="#nueva-caracteristica-pane" 
        type="button" role="tab" aria-controls="nueva-caracteristica-pane" aria-selected="false">
        <span class="servicio-tab-icon">
            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
            </svg>
        </span>
        Nueva Característica
    </button>
</li>
        @if(isset($editarServicio))
            <li class="servicio-tab-item" role="presentation">
                <button class="servicio-tab-link" id="editar-tab" data-bs-toggle="tab" data-bs-target="#editar-tab-pane" 
                    type="button" role="tab" aria-controls="editar-tab-pane" aria-selected="false">
                    <span class="servicio-tab-icon">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                        </svg>
                    </span>
                    Editar Servicio
                </button>
            </li>
        @endif
        @if(isset($editarCaracteristica))
            <li class="servicio-tab-item" role="presentation">
                <button class="servicio-tab-link" id="caracteristica-tab" data-bs-toggle="tab" data-bs-target="#caracteristica-tab-pane" 
                    type="button" role="tab" aria-controls="caracteristica-tab-pane" aria-selected="false">
                    <span class="servicio-tab-icon">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 11H5m14 0a2 2 0 012 2v6a2 2 0 01-2 2H5a2 2 0 01-2-2v-6a2 2 0 012-2m14 0V9a2 2 0 00-2-2M5 11V9a2 2 0 012-2m0 0V5a2 2 0 012-2h6a2 2 0 012 2v2M7 7h10"></path>
                        </svg>
                    </span>
                    Editar Característica
                </button>
            </li>
        @endif
        <li class="servicio-tab-item" role="presentation">
            <button class="servicio-tab-link" id="nuevo-tab" data-bs-toggle="tab" data-bs-target="#nuevo-tab-pane" 
                type="button" role="tab" aria-controls="nuevo-tab-pane" aria-selected="false">
                <span class="servicio-tab-icon">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                    </svg>
                </span>
                Nuevo Servicio
            </button>
        </li>
    </ul>
    <!-- Contenido de las pestañas -->
    <div class="servicio-tab-content" id="serviciosTabsContent">
        <!-- Pestaña: Listado de servicios -->
        <div class="servicio-tab-pane active" id="lista-tab-pane" role="tabpanel" aria-labelledby="lista-tab" tabindex="0">
            <div class="servicio-card-body">
                <table id="serviciosTable" class="servicio-table">
                    <thead>
                        <tr>
                            <th width="5%">Orden</th>
                            <th width="15%">Imagen</th>
                            <th width="20%">Título</th>
                            <th width="10%">Etiqueta</th>
                            <th width="10%">Estado</th>
                            <th width="25%">Acciones</th>
                        </tr>
                    </thead>
                    <tbody id="servicios-sortable">
                        @foreach ($servicios as $servicio)
                        <tr data-id="{{ $servicio->id }}">
                            <td>
                                <span class="servicio-handle">
                                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path>
                                    </svg>
                                </span>
                                {{ $servicio->orden }}
                            </td>
                            <td>
                                @if($servicio->imagen)
                                    <img src="{{ asset($servicio->imagen) }}" alt="{{ $servicio->nombre }}" class="servicio-thumbnail">
                                @else
                                    <span class="servicio-badge servicio-badge-secondary">Sin imagen</span>
                                @endif
                            </td>
                            <td>{{ $servicio->titulo }}</td>
                            <td><span class="servicio-badge servicio-badge-info">{{ $servicio->etiqueta }}</span></td>
                            <td>
                                @if($servicio->activo)
                                    <span class="servicio-badge servicio-badge-success">Activo</span>
                                @else
                                    <span class="servicio-badge servicio-badge-danger">Inactivo</span>
                                @endif
                            </td>
                            <td>
                                <div class="servicio-d-flex">
                                    <a href="{{ route('admin.servicios.edit', $servicio->id) }}" class="servicio-btn servicio-btn-warning servicio-btn-sm">
                                        <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                        </svg>
                                        Editar
                                    </a>
                                    <form action="{{ route('admin.servicios.destroy', $servicio->id) }}" method="POST" class="d-inline delete-form">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="servicio-btn servicio-btn-danger servicio-btn-sm">
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
            </div>
        </div>
        <!-- Pestaña: Editar servicio existente -->
        @if(isset($editarServicio))
        <div class="servicio-tab-pane" id="editar-tab-pane" role="tabpanel" aria-labelledby="editar-tab" tabindex="0">
            <div class="servicio-card-body">
                <form action="{{ route('admin.servicios.update', $editarServicio->id) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    
                    <div class="servicio-row">
                        <div class="servicio-col-6 servicio-col-md-12">
                            <div class="servicio-form-group">
                                <label for="nombre" class="servicio-label">Nombre interno</label>
                                <input type="text" class="servicio-input" id="nombre" name="nombre" value="{{ old('nombre', $editarServicio->nombre) }}" required>
                                <small class="servicio-helper-text">Nombre para identificación interna</small>
                            </div>
                            
                            <div class="servicio-form-group">
                                <label for="etiqueta" class="servicio-label">Etiqueta</label>
                                <input type="text" class="servicio-input" id="etiqueta" name="etiqueta" value="{{ old('etiqueta', $editarServicio->etiqueta) }}" required>
                                <small class="servicio-helper-text">Texto corto que aparece sobre el título</small>
                            </div>
                            
                            <div class="servicio-form-group">
                                <label for="titulo" class="servicio-label">Título</label>
                                <input type="text" class="servicio-input" id="titulo" name="titulo" value="{{ old('titulo', $editarServicio->titulo) }}" required>
                            </div>
                            
                            <div class="servicio-form-group">
                                <label for="orden" class="servicio-label">Orden</label>
                                <input type="number" class="servicio-input" id="orden" name="orden" value="{{ old('orden', $editarServicio->orden) }}" required>
                            </div>

                            <div class="servicio-col-6 servicio-col-md-12">
                            <div class="servicio-form-group">
                                <label for="imagen" class="servicio-label">Imagen</label>
                                @if($editarServicio->imagen)
                                    <div class="servicio-my-3">
                                        <img src="{{ asset($editarServicio->imagen) }}" alt="{{ $editarServicio->nombre }}" class="servicio-thumbnail" style="max-height: 150px;">
                                    </div>
                                @endif
                                <input type="file" class="servicio-input" id="imagen" name="imagen">
                                <small class="servicio-helper-text">Deja en blanco para mantener la imagen actual</small>
                            </div>

                            <div class="servicio-form-group">
                                <label for="descripcion" class="servicio-label">Descripción</label>
                                <textarea class="servicio-textarea" id="descripcion" name="descripcion" rows="5" required>{{ old('descripcion', $editarServicio->descripcion) }}</textarea>
                            </div>
                        </div>
                    </div>

                    <h1>Vista dentro de la noticia<h1>
                            
                                                        <!-- Campos editables para la tabla servicio -->
<div class="servicio-row">
    <div class="servicio-col-md-12 mb-3">
        <label class="servicio-label">Título de la Noticia</label>
        <input type="text" name="titulonoticia" class="servicio-input" value="{{ old('titulonoticia', $servicio->titulonoticia ?? '') }}" required>
        <small class="servicio-helper-text">Título principal que se mostrará en la página</small>
    </div>
    
    <div class="servicio-col-md-12 mb-3">
        <label class="servicio-label">Imagen de la Noticia</label>
        <input type="file" name="imagennoticia" class="servicio-input">
        @if(isset($servicio) && $servicio->imagennoticia)
            <div class="mt-2">
                <img src="{{ asset('storage/' . $servicio->imagennoticia) }}" alt="{{ $servicio->titulonoticia }}" class="img-thumbnail" style="max-height: 150px;">
                <small class="servicio-helper-text d-block">Imagen actual. Sube una nueva para reemplazarla.</small>
            </div>
        @endif
        <small class="servicio-helper-text">Imagen destacada que aparecerá en el listado y cabecera de la noticia</small>
    </div>
    
    <div class="servicio-col-md-12 mb-3">
        <label class="servicio-label">Contenido</label>
        <textarea name="contenido" id="editor" rows="10" class="servicio-textarea">{{ old('contenido', $servicio->contenido ?? '') }}</textarea>
        <small class="servicio-helper-text">Contenido principal de la noticia con formato HTML</small>
    </div>
</div>

<div class="servicio-row">
    <div class="servicio-col-md-6 mb-3">
        <div class="servicio-form-group mb-3">
            <label class="servicio-label d-block">Estado</label>
            <div class="servicio-switch mt-2">
                <input type="checkbox" class="servicio-switch-input" id="activo" name="activo" 
                    {{ (isset($servicio) && $servicio->activo) || old('activo') ? 'checked' : '' }}>
                <span class="servicio-switch-slider"></span>
            </div>
            <label for="activo" class="servicio-label">Activo</label>
        </div>
    </div>
</div>
                        </div>
                        

                            

                    <div class="servicio-d-flex servicio-justify-between servicio-my-3">
                        <a href="{{ route('admin.servicios.index') }}" class="servicio-btn servicio-btn-secondary">
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                            </svg>
                            Volver
                        </a>
                        <button type="submit" class="servicio-btn servicio-btn-primary">
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7H5a2 2 0 00-2 2v9a2 2 0 002 2h14a2 2 0 002-2V9a2 2 0 00-2-2h-3m-1 4l-3 3m0 0l-3-3m3 3V4"></path>
                            </svg>
                            Guardar cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
        @endif
        <!-- Pestaña: Nuevo servicio -->
        <div class="servicio-tab-pane" id="nuevo-tab-pane" role="tabpanel" aria-labelledby="nuevo-tab" tabindex="0">
            <div class="servicio-card-body">
                <form action="{{ route('admin.servicios.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    
                    <div class="servicio-row">
                        <div class="servicio-col-6 servicio-col-md-12">
                            <div class="servicio-form-group">
                                <label for="nombre" class="servicio-label">Nombre interno</label>
                                <input type="text" class="servicio-input" id="nombre" name="nombre" value="{{ old('nombre') }}" required>
                                <small class="servicio-helper-text">Nombre para identificación interna</small>
                            </div>
                            
                            <div class="servicio-form-group">
                                <label for="etiqueta" class="servicio-label">Etiqueta</label>
                                <input type="text" class="servicio-input" id="etiqueta" name="etiqueta" value="{{ old('etiqueta') }}" required>
                                <small class="servicio-helper-text">Texto corto que aparece sobre el título</small>
                            </div>
                            
                            <div class="servicio-form-group">
                                <label for="titulo" class="servicio-label">Título</label>
                                <input type="text" class="servicio-input" id="titulo" name="titulo" value="{{ old('titulo') }}" required>
                            </div>
                            
                            <div class="servicio-form-group">
                                <label for="orden" class="servicio-label">Orden</label>
                                <input type="number" class="servicio-input" id="orden" name="orden" value="{{ old('orden', $ultimoOrden + 1) }}" required>
                            </div>
                        
                        <div class="servicio-col-6 servicio-col-md-12">
                            <div class="servicio-form-group">
                                <label for="imagen" class="servicio-label">Imagen</label>
                                <input type="file" class="servicio-input" id="imagen" name="imagen">
                                <small class="servicio-helper-text">Dimensiones recomendadas: 800x600px</small>
                            </div>
                            
                            <div class="servicio-form-group">
                                <label for="descripcion" class="servicio-label">Descripción</label>
                                <textarea class="servicio-textarea" id="descripcion" name="descripcion" rows="5" required>{{ old('descripcion') }}</textarea>
                            </div>
                            <!-- Campos editables para la tabla servicio -->
                            <h1>Vista dentro de la noticia<h1>
                            <div class="servicio-row">
                                <div class="servicio-col-md-12 mb-3">
                                    <label class="servicio-label">Título de la Noticia</label>
                                    <input type="text" name="titulonoticia" class="servicio-input" value="{{ old('titulonoticia', $servicio->titulonoticia ?? '') }}" required>
                                    <small class="servicio-helper-text">Título principal que se mostrará en la página</small>
                                </div>
                                
                                <div class="servicio-col-md-12 mb-3">
                                    <label class="servicio-label">Imagen de la Noticia</label>
                                    <input type="file" name="imagennoticia" class="servicio-input">
                                    @if(isset($servicio) && $servicio->imagennoticia)
                                        <div class="mt-2">
                                            <img src="{{ asset('storage/' . $servicio->imagennoticia) }}" alt="{{ $servicio->titulonoticia }}" class="img-thumbnail" style="max-height: 150px;">
                                            <small class="servicio-helper-text d-block">Imagen actual. Sube una nueva para reemplazarla.</small>
                                        </div>
                                    @endif
                                    <small class="servicio-helper-text">Imagen destacada que aparecerá en el listado y cabecera de la noticia</small>
                                </div>
                                
                                <div class="servicio-col-md-12 mb-3">
                                    <label class="servicio-label">Contenido</label>
                                    <textarea name="contenido" id="editor" rows="10" class="servicio-textarea">{{ old('contenido', $servicio->contenido ?? '') }}</textarea>
                                    <small class="servicio-helper-text">Contenido principal de la noticia con formato HTML</small>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="servicio-d-flex servicio-justify-between servicio-my-3">
                        <div></div>
                        <button type="submit" class="servicio-btn servicio-btn-success">
                            <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                            </svg>
                            Crear Servicio
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Activar la pestaña correspondiente según la acción actual
    @if(isset($editarServicio))
        document.getElementById('editar-tab').click();
    @endif
    
    @if(isset($editarCaracteristica))
        document.getElementById('caracteristica-tab').click();
    @endif
    
    // Sortable para reordenar servicios
    if (document.getElementById('servicios-sortable')) {
        var serviciosSortable = Sortable.create(document.getElementById('servicios-sortable'), {
            handle: '.servicio-handle',
            animation: 150,
            onEnd: function (evt) {
                var itemIds = [];
                var items = evt.to.children;
                
                for (var i = 0; i < items.length; i++) {
                    itemIds.push(items[i].getAttribute('data-id'));
                }
                
                // Enviar solicitud AJAX para actualizar el orden
                fetch('{{ route('admin.servicios.reorder') }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        ids: itemIds
                    })
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        // Opcional: mostrar mensaje de éxito
                    }
                });
            }
        });
    }
    
    // Sortable para reordenar características
    if (document.getElementById('caracteristicas-sortable')) {
        var caracteristicasSortable = Sortable.create(document.getElementById('caracteristicas-sortable'), {
            handle: '.servicio-handle',
            animation: 150,
            onEnd: function (evt) {
                var itemIds = [];
                var items = evt.to.children;
                
                for (var i = 0; i < items.length; i++) {
                    itemIds.push(items[i].getAttribute('data-id'));
                }
                
                // Enviar solicitud AJAX para actualizar el orden
                fetch('{{ isset($servicioActual) ? route('admin.caracteristicas.reorder', $servicioActual->id) : '#' }}', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        ids: itemIds
                    })
                })
                .then(response => response.json()).then(data => {
                    if (data.success) {
                        // Opcional: mostrar mensaje de éxito
                    }
                });
            }
        });
    }
    
    // Vista previa de iconos
    const iconos = @json($iconos ?? []);
    
    // Para la página de edición
    const selectIcono = document.getElementById('icono');
    const iconPreview = document.getElementById('iconPreview');
    
    if (selectIcono && iconPreview) {
        selectIcono.addEventListener('change', function() {
            const selectedIcon = this.value;
            if (selectedIcon && iconos[selectedIcon]) {
                iconPreview.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" class="text-primary">
                        ${iconos[selectedIcon]}
                    </svg>
                `;
            } else {
                iconPreview.innerHTML = '<div class="text-muted">Selecciona un icono para ver la vista previa</div>';
            }
        });
    }
    
    // Para el modal
    const modalSelectIcono = document.getElementById('modal-icono');
    const modalIconPreview = document.getElementById('modalIconPreview');
    
    if (modalSelectIcono && modalIconPreview) {
        modalSelectIcono.addEventListener('change', function() {
            const selectedIcon = this.value;
            if (selectedIcon && iconos[selectedIcon]) {
                modalIconPreview.innerHTML = `
                    <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" class="text-primary">
                        ${iconos[selectedIcon]}
                    </svg>
                `;
            } else {
                modalIconPreview.innerHTML = '<div class="text-muted">Selecciona un icono para ver la vista previa</div>';
            }
        });
    }
    
    // Confirmación para eliminar
    document.querySelectorAll('.delete-form').forEach(form => {
        form.addEventListener('submit', function(e) {
            e.preventDefault();
            if (confirm('¿Estás seguro de que deseas eliminar este elemento? Esta acción no se puede deshacer.')) {
                this.submit();
            }
        });
    });
    
    // Inicializar DataTables para la tabla de servicios
    if (document.getElementById('serviciosTable')) {
        $('#serviciosTable').DataTable({
            language: {
                url: "//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json"
            },
            order: [[0, 'asc']],
            columnDefs: [
                { orderable: false, targets: [1, 5, 6] }
            ]
        });
    }
});
</script>
@endsection
