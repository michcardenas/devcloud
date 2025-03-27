@extends('layouts.admin')

@section('content')
<div class="servicio-container">
    <h1 class="servicio-title">Administración de Categorías</h1>

    <ul class="servicio-breadcrumb">
        <li class="servicio-breadcrumb-item">
            <a href="{{ route('dashboard') }}" class="servicio-breadcrumb-link">Dashboard</a>
        </li>
        <li class="servicio-breadcrumb-item">
            <span class="servicio-breadcrumb-active">Categorías</span>
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
            <a href="{{ route('admin.categorias.index') }}" class="servicio-tab-link active">
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
            <a href="{{ route('admin.configuracion-noticias.edit') }}" class="servicio-tab-link">
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

            <div class="servicio-d-flex servicio-justify-between servicio-align-center servicio-my-3">
                <h2 style="font-size: 1.2rem; margin: 0;">Listado de Categorías</h2>
                <button type="button" class="servicio-btn servicio-btn-primary" id="btnNuevaCategoria">
                    <span class="servicio-btn-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                    </span>
                    Nueva Categoría
                </button>
            </div>

            <div class="table-responsive">
                <table class="servicio-table">
                    <thead>
                        <tr>
                            <th width="60">ID</th>
                            <th>Nombre</th>
                            <th>Slug</th>
                            <th>Icono</th>
                            <th width="100">Estado</th>
                            <th width="100">Noticias</th>
                            <th width="150">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categorias as $categoria)
                        <tr>
                            <td>{{ $categoria->id }}</td>
                            <td>{{ $categoria->nombre }}</td>
                            <td>{{ $categoria->slug }}</td>
                            <td>
                                @if($categoria->icono)
                                <i class="{{ $categoria->icono }}"></i> {{ $categoria->icono }}
                                @else
                                <span class="servicio-text-muted">Sin icono</span>
                                @endif
                            </td>
                            <td>
                                @if($categoria->activa)
                                <span class="servicio-badge servicio-badge-success">Activa</span>
                                @else
                                <span class="servicio-badge servicio-badge-secondary">Inactiva</span>
                                @endif
                            </td>
                            <td>{{ $categoria->noticias_count }}</td>
                            <td>
                                <div class="servicio-d-flex">
                                    <button type="button" class="servicio-btn servicio-btn-sm servicio-btn-primary btn-editar-categoria" style="margin-right: 5px;" title="Editar"
                                        data-id="{{ $categoria->id }}"
                                        data-nombre="{{ $categoria->nombre }}"
                                        data-icono="{{ $categoria->icono }}"
                                        data-activa="{{ $categoria->activa }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </button>
                                    @if($categoria->noticias_count == 0)
                                    <button type="button" class="servicio-btn servicio-btn-sm servicio-btn-danger btn-eliminar-categoria" title="Eliminar"
                                        data-id="{{ $categoria->id }}"
                                        data-nombre="{{ $categoria->nombre }}">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                        </svg>
                                    </button>
                                    @else
                                    <button type="button" class="servicio-btn servicio-btn-sm servicio-btn-danger" disabled title="No se puede eliminar porque tiene noticias asociadas">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                        </svg>
                                    </button>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 2rem;">
                                <p>No hay categorías disponibles</p>
                                <button type="button" class="servicio-btn servicio-btn-primary servicio-btn-sm" id="btnPrimeraCategoria">
                                    <span class="servicio-btn-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="12" y1="5" x2="12" y2="19"></line>
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                        </svg>
                                    </span>
                                    Crear primera categoría
                                </button>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div style="margin-top: 20px;">
                @if(method_exists($categorias, 'links'))
                {{ $categorias->links() }}
                @endif
            </div>
        </div>
    </div>
</div>

<!-- Modal para Crear Categoría -->
<div id="createCategoriaModal" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Nueva Categoría</h2>
            <span class="close" id="closeCreateModal">&times;</span>
        </div>
        <div class="modal-body">
            <form id="createCategoriaForm" action="{{ route('admin.categorias.store') }}" method="POST">
                @csrf
                <div class="servicio-form-group">
                    <label for="nombre" class="servicio-label">Nombre <span class="servicio-text-danger">*</span></label>
                    <input type="text" id="nombre" name="nombre" class="servicio-input" required maxlength="255">
                </div>

                <div class="servicio-form-group">
                    <label for="icono" class="servicio-label">Icono (clase FontAwesome)</label>
                    <div class="servicio-input-group">
                        <div class="servicio-input-prepend">
                            <span class="servicio-input-text"><i class="fas fa-icons" id="create_icono_preview"></i></span>
                        </div>
                        <input type="text" id="icono" name="icono" class="servicio-input" placeholder="ej: fas fa-home">
                    </div>
                    <span class="servicio-helper-text">Deja en blanco si no deseas un icono</span>
                </div>

                <div class="servicio-checkbox-container">
                    <div class="servicio-switch">
                        <input type="checkbox" id="activa" name="activa" class="servicio-switch-input" checked>
                        <span class="servicio-switch-slider"></span>
                    </div>
                    <label for="activa" class="servicio-label" style="margin-bottom: 0;">Categoría activa</label>
                </div>

                <div class="servicio-d-flex servicio-justify-between" style="margin-top: 20px;">
                    <button type="button" class="servicio-btn servicio-btn-outline" id="cancelCreateBtn">Cancelar</button>
                    <button type="submit" class="servicio-btn servicio-btn-primary">Guardar Categoría</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para Editar Categoría -->
<div id="editCategoriaModal" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Editar Categoría</h2>
            <span class="close" id="closeEditModal">&times;</span>
        </div>
        <div class="modal-body">
            <form id="editCategoriaForm" action="" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_categoria_id" name="categoria_id">

                <div class="servicio-form-group">
                    <label for="edit_nombre" class="servicio-label">Nombre <span class="servicio-text-danger">*</span></label>
                    <input type="text" id="edit_nombre" name="nombre" class="servicio-input" required maxlength="255">
                </div>

                <div class="servicio-form-group">
                    <label for="edit_icono" class="servicio-label">Icono (clase FontAwesome)</label>
                    <div class="servicio-input-group">
                        <div class="servicio-input-prepend">
                            <span class="servicio-input-text"><i id="edit_icono_preview" class="fas fa-icons"></i></span>
                        </div>
                        <input type="text" id="edit_icono" name="icono" class="servicio-input" placeholder="ej: fas fa-home">
                    </div>
                    <span class="servicio-helper-text">Deja en blanco si no deseas un icono</span>
                </div>

                <div class="servicio-checkbox-container">
                    <div class="servicio-switch">
                        <input type="checkbox" id="edit_activa" name="activa" class="servicio-switch-input">
                        <span class="servicio-switch-slider"></span>
                    </div>
                    <label for="edit_activa" class="servicio-label" style="margin-bottom: 0;">Categoría activa</label>
                </div>

                <div class="servicio-d-flex servicio-justify-between" style="margin-top: 20px;">
                    <button type="button" class="servicio-btn servicio-btn-outline" id="cancelEditBtn">Cancelar</button>
                    <button type="submit" class="servicio-btn servicio-btn-primary">Actualizar Categoría</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para Eliminar Categoría -->
<div id="deleteCategoriaModal" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Confirmar eliminación</h2>
            <span class="close" id="closeDeleteModal">&times;</span>
        </div>
        <div class="modal-body">
            <p>¿Estás seguro que deseas eliminar la categoría <strong id="delete_categoria_nombre"></strong>?</p>
            <p class="servicio-text-danger">Esta acción no se puede deshacer.</p>

            <div class="servicio-d-flex servicio-justify-between" style="margin-top: 20px;">
                <button type="button" class="servicio-btn servicio-btn-outline" id="cancelDeleteBtn">Cancelar</button>
                <form id="deleteCategoriaForm" action="" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="servicio-btn servicio-btn-danger">Eliminar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection