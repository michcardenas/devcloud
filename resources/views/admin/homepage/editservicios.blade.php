@extends('layouts.admin')

@section('content')
<div class="servicio-container">
    <h1 class="servicio-title">Gestión de Servicios</h1>
    <ul class="servicio-breadcrumb">
        <li class="servicio-breadcrumb-item"><a href="{{ route('admin.homepage.index') }}" class="servicio-breadcrumb-link">Dashboard</a></li>
        <li class="servicio-breadcrumb-item"><span class="servicio-breadcrumb-active">Editar Servicios</span></li>
    </ul>

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
                            <th width="15%">Características</th>
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
                            <td class="text-center">
                                <span class="servicio-badge servicio-badge-primary">{{ $servicio->caracteristicas->count() }}</span>
                                <a href="{{ route('admin.servicios.caracteristicas', $servicio->id) }}" class="servicio-btn servicio-btn-outline servicio-btn-sm">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                                    </svg>
                                    Ver
                                </a>
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
                            
                            <div class="servicio-checkbox-container">
                                <div class="servicio-switch">
                                    <input type="checkbox" class="servicio-switch-input" id="activo" name="activo" value="1" {{ old('activo', $editarServicio->activo) ? 'checked' : '' }}>
                                    <span class="servicio-switch-slider"></span>
                                </div>
                                <label for="activo" class="servicio-label">Activo</label>
                            </div>
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
        <!-- Pestaña: Editar característica -->
        @if(isset($editarCaracteristica))
        <div class="servicio-tab-pane" id="caracteristica-tab-pane" role="tabpanel" aria-labelledby="caracteristica-tab" tabindex="0">
            <div class="servicio-card-body">
                <form action="{{ route('admin.caracteristicas.update', $editarCaracteristica->id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <input type="hidden" name="servicio_id" value="{{ $editarCaracteristica->servicio_id }}">
                    
                    <div class="servicio-row">
                        <div class="servicio-col-6 servicio-col-md-12">
                            <div class="servicio-form-group">
                                <label for="titulo" class="servicio-label">Título</label>
                                <input type="text" class="servicio-input" id="titulo" name="titulo" value="{{ old('titulo', $editarCaracteristica->titulo) }}" required>
                            </div>
                            
                            <div class="servicio-form-group">
                                <label for="descripcion" class="servicio-label">Descripción</label>
                                <textarea class="servicio-textarea" id="descripcion" name="descripcion" rows="3" required>{{ old('descripcion', $editarCaracteristica->descripcion) }}</textarea>
                            </div>
                            
                            <div class="servicio-form-group">
                                <label for="orden" class="servicio-label">Orden</label>
                                <input type="number" class="servicio-input" id="orden" name="orden" value="{{ old('orden', $editarCaracteristica->orden) }}" required>
                            </div>
                        </div>
                        
                        <div class="servicio-col-6 servicio-col-md-12">
                            <div class="servicio-form-group">
                                <label for="icono" class="servicio-label">Icono</label>
                                <select class="servicio-select" id="icono" name="icono" required>
                                    <option value="">Selecciona un icono</option>
                                    @foreach($iconos as $key => $svg)
                                        <option value="{{ $key }}" {{ old('icono', $editarCaracteristica->icono) == $key ? 'selected' : '' }}>
                                            {{ ucfirst($key) }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="servicio-form-group">
                                <label class="servicio-label">Vista previa del icono</label>
                                <div class="servicio-icon-preview" id="iconPreview">
                                    @if($editarCaracteristica->icono && isset($iconos[$editarCaracteristica->icono]))
                                        <svg xmlns="http://www.w3.org/2000/svg" width="48" height="48" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                                            {!! $iconos[$editarCaracteristica->icono] !!}
                                        </svg>
                                    @else
                                        <div class="text-muted">Selecciona un icono para ver la vista previa</div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="servicio-d-flex servicio-justify-between servicio-my-3">
                        <a href="{{ route('admin.servicios.caracteristicas', $editarCaracteristica->servicio_id) }}" class="servicio-btn servicio-btn-secondary">
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
                            
                            <div class="servicio-checkbox-container">
                                <div class="servicio-switch">
                                    <input type="checkbox" class="servicio-switch-input" id="activo" name="activo" value="1" checked>
                                    <span class="servicio-switch-slider"></span>
                                </div>
                                <label for="activo" class="servicio-label">Activo</label>
                            </div>
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
    <!-- Si estamos en la vista de características -->
    @if(isset($servicioActual) && isset($caracteristicas))
    <div class="servicio-card servicio-my-3">
        <div class="servicio-card-header">
            <div class="servicio-d-flex servicio-align-center">
                <svg width="20" height="20" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" class="me-2">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 10h16M4 14h16M4 18h16"></path>
                </svg>
                <h3 class="servicio-card-title">Características del servicio: <strong>{{ $servicioActual->nombre }}</strong></h3>
            </div>
            <button type="button" class="servicio-btn servicio-btn-primary servicio-btn-sm" data-bs-toggle="modal" data-bs-target="#nuevaCaracteristicaModal">
                <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                </svg>
                Nueva Característica
            </button>
        </div>
        <div class="servicio-card-body">
            @if($caracteristicas->count() > 0)
            <table class="servicio-table">
                <thead>
                    <tr>
                        <th width="5%">Orden</th>
                        <th width="10%">Icono</th>
                        <th width="25%">Título</th>
                        <th width="40%">Descripción</th>
                        <th width="20%">Acciones</th>
                    </tr>
                </thead>
                <tbody id="caracteristicas-sortable">
                    @foreach($caracteristicas as $caracteristica)
                    <tr data-id="{{ $caracteristica->id }}">
                        <td>
                            <span class="servicio-handle">
                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 8h16M4 16h16"></path>
                                </svg>
                            </span>
                            {{ $caracteristica->orden }}
                        </td>
                        <td class="text-center">
                            @if(isset($iconos[$caracteristica->icono]))
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" class="text-primary">
                                    {!! $iconos[$caracteristica->icono] !!}
                                </svg>
                            @else
                                <span class="servicio-badge servicio-badge-secondary">Sin icono</span>
                            @endif
                        </td>
                        <td>{{ $caracteristica->titulo }}</td>
                        <td>{{ Str::limit($caracteristica->descripcion, 80) }}</td>
                        <td>
                            <div class="servicio-d-flex">
                                <a href="{{ route('admin.caracteristicas.edit', $caracteristica->id) }}" class="servicio-btn servicio-btn-warning servicio-btn-sm">
                                    <svg width="14" height="14" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z"></path>
                                    </svg>
                                    Editar
                                </a>
                                <form action="{{ route('admin.caracteristicas.destroy', $caracteristica->id) }}" method="POST" class="d-inline delete-form">
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
            @else
            <div class="servicio-alert servicio-alert-info">
                Este servicio aún no tiene características. Haz clic en "Nueva Característica" para agregar una.
            </div>
            @endif
            
            <div class="servicio-my-3">
                <a href="{{ route('admin.servicios.index') }}" class="servicio-btn servicio-btn-secondary">
                    <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18"></path>
                    </svg>
                    Volver a Servicios
                </a>
            </div>
        </div>
    </div>
    
    <!-- Modal: Nueva Característica -->
    <div class="modal fade" id="nuevaCaracteristicaModal" tabindex="-1" aria-labelledby="nuevaCaracteristicaModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content servicio-card">
                <div class="servicio-card-header">
                    <h5 class="servicio-card-title" id="nuevaCaracteristicaModalLabel">Nueva Característica</h5>
                    <button type="button" class="servicio-alert-close" data-bs-dismiss="modal" aria-label="Close">
                        <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                    </button>
                </div>
                <form action="{{ route('admin.caracteristicas.store') }}" method="POST">
                    @csrf
                    <div class="servicio-card-body">
                        <input type="hidden" name="servicio_id" value="{{ $servicioActual->id }}">
                        
                        <div class="servicio-row">
                            <div class="servicio-col-6 servicio-col-md-12">
                                <div class="servicio-form-group">
                                    <label for="titulo" class="servicio-label">Título</label>
                                    <input type="text" class="servicio-input" id="titulo" name="titulo" required>
                                </div>
                                
                                <div class="servicio-form-group">
                                    <label for="descripcion" class="servicio-label">Descripción</label>
                                    <textarea class="servicio-textarea" id="descripcion" name="descripcion" rows="3" required></textarea>
                                </div>
                                
                                <div class="servicio-form-group">
                                    <label for="orden" class="servicio-label">Orden</label>
                                    <input type="number" class="servicio-input" id="orden" name="orden" value="{{ $caracteristicas->count() + 1 }}" required>
                                </div>
                            </div>
                            
                            <div class="servicio-col-6 servicio-col-md-12">
                                <div class="servicio-form-group">
                                    <label for="icono" class="servicio-label">Icono</label>
                                    <select class="servicio-select" id="modal-icono" name="icono" required>
                                        <option value="">Selecciona un icono</option>
                                        @foreach($iconos as $key => $svg)
                                            <option value="{{ $key }}">{{ ucfirst($key) }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                
                                <div class="servicio-form-group">
                                    <label class="servicio-label">Vista previa del icono</label>
                                    <div class="servicio-icon-preview" id="modalIconPreview">
                                        <div class="text-muted">Selecciona un icono para ver la vista previa</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="servicio-card-footer">
                        <div class="servicio-d-flex servicio-justify-between">
                            <button type="button" class="servicio-btn servicio-btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="servicio-btn servicio-btn-success">
                                <svg width="16" height="16" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6v6m0 0v6m0-6h6m-6 0H6"></path>
                                </svg>
                                Crear Característica
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    @endif
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