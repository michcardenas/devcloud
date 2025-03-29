@extends('layouts.admin')

@section('content')
<div class="servicio-container">
    <h1 class="servicio-title">Administración de Sala de Prensa</h1>

    <ul class="servicio-breadcrumb">
        <li class="servicio-breadcrumb-item">
            <a href="{{ route('dashboard') }}" class="servicio-breadcrumb-link">Dashboard</a>
        </li>
        <li class="servicio-breadcrumb-item">
            <a href="{{ route('admin.prensa.index') }}" class="servicio-breadcrumb-link">Sala de Prensa</a>
        </li>
        <li class="servicio-breadcrumb-item">
            <span class="servicio-breadcrumb-active">Categorías</span>
        </li>
    </ul>

    <ul class="servicio-tabs">
        <li class="servicio-tab-item">
            <a href="{{ route('admin.prensa.index') }}" class="servicio-tab-link">
                <span class="servicio-tab-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M14 2H6a2 2 0 0 0-2 2v16a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V8z"></path>
                        <polyline points="14 2 14 8 20 8"></polyline>
                        <line x1="16" y1="13" x2="8" y2="13"></line>
                        <line x1="16" y1="17" x2="8" y2="17"></line>
                        <polyline points="10 9 9 9 8 9"></polyline>
                    </svg>
                </span>
                Contenidos
            </a>
        </li>
        <li class="servicio-tab-item">
            <a href="{{ route('admin.prensa.categorias') }}" class="servicio-tab-link active">
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
            <a href="{{ route('admin.prensa.configuracion') }}" class="servicio-tab-link">
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
                    <h3 class="servicio-card-title">Categorías Disponibles</h3>
                    <p class="servicio-card-subtitle">Las categorías se utilizan para organizar el contenido de la Sala de Prensa</p>
                </div>
                <div class="servicio-card-body">
                    <div class="servicio-d-flex servicio-justify-between servicio-align-center servicio-mb-4">
                        <p class="servicio-text-muted">Categorías predefinidas para la Sala de Prensa</p>
                        <button type="button" class="servicio-btn servicio-btn-primary servicio-btn-sm" onclick="openCreateModal()">
                            <span class="servicio-btn-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                            </span>
                            Agregar categoría
                        </button>
                    </div>

                    <div class="servicio-categories-list">
                        @forelse($categorias as $categoria)
                            <div class="servicio-category-item">
                                <div class="servicio-category-content">
                                    <h4 class="servicio-category-title">{{ $categoria->nombre }}</h4>
                                    <p class="servicio-category-description">{{ $categoria->descripcion }}</p>
                                    <div class="servicio-category-meta">
                                        <span class="servicio-badge servicio-badge-secondary">{{ $categoria->prensas()->count() }} contenidos</span>
                                    </div>
                                </div>
                                <div class="servicio-category-actions">
                                    <button type="button" class="servicio-btn servicio-btn-sm servicio-btn-outline" onclick="editCategory('{{ $categoria->id }}', '{{ $categoria->nombre }}', '{{ $categoria->descripcion }}')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                        Editar
                                    </button>
                                    <button type="button" class="servicio-btn servicio-btn-sm servicio-btn-danger" onclick="deleteCategory('{{ $categoria->id }}', '{{ $categoria->nombre }}')">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <polyline points="3 6 5 6 21 6"></polyline>
                                            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                            <line x1="10" y1="11" x2="10" y2="17"></line>
                                            <line x1="14" y1="11" x2="14" y2="17"></line>
                                        </svg>
                                        Eliminar
                                    </button>
                                </div>
                            </div>
                        @empty
                            <div class="servicio-alert servicio-alert-info">
                                No hay categorías disponibles. Agrega una nueva categoría para comenzar.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>

            <div class="servicio-card mt-4">
                <div class="servicio-card-header">
                    <h3 class="servicio-card-title">Subtipos</h3>
                    <p class="servicio-card-subtitle">Estos subtipos se utilizan para clasificar las apariciones en diferentes medios de comunicación</p>
                </div>
                <div class="servicio-card-body">
                    <div class="servicio-d-flex servicio-justify-between servicio-align-center servicio-mb-4">
                        <p class="servicio-text-muted">Configuración de subtipos</p>
                        <button type="button" class="servicio-btn servicio-btn-primary servicio-btn-sm" onclick="openCreateSubtipoModal()">
                            <span class="servicio-btn-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                </svg>
                            </span>
                            Agregar subtipo
                        </button>
                    </div>

                    <div class="table-responsive">
                        <table class="servicio-table">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th width="150">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($subtipos as $subtipo)
                                    <tr>
                                        <td>{{ $subtipo->nombre }}</td>
                                        <td>
                                            <div class="servicio-d-flex">
                                                <button type="button" class="servicio-btn servicio-btn-sm servicio-btn-outline" style="margin-right: 5px;" onclick="editSubtipo('{{ $subtipo->id }}', '{{ $subtipo->nombre }}')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                        <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                    </svg>
                                                </button>
                                                <button type="button" class="servicio-btn servicio-btn-sm servicio-btn-danger" onclick="deleteSubtipo('{{ $subtipo->id }}', '{{ $subtipo->nombre }}')">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                        <polyline points="3 6 5 6 21 6"></polyline>
                                                        <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                        <line x1="10" y1="11" x2="10" y2="17"></line>
                                                        <line x1="14" y1="11" x2="14" y2="17"></line>
                                                    </svg>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="2" class="text-center">No hay subtipos disponibles</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Crear Categoría -->
<div id="createCategoryModal" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Nueva Categoría</h2>
            <span class="close" onclick="closeCreateModal()">&times;</span>
        </div>
        <div class="modal-body">
            <form id="createCategoryForm" action="{{ route('admin.prensa.categorias.store') }}" method="POST">
                @csrf
                <div class="servicio-form-group">
                    <label for="nombre" class="servicio-label">Nombre de la categoría</label>
                    <input type="text" id="nombre" name="nombre" class="servicio-input" required>
                </div>

                <div class="servicio-form-group">
                    <label for="descripcion" class="servicio-label">Descripción</label>
                    <textarea id="descripcion" name="descripcion" class="servicio-textarea" rows="3"></textarea>
                </div>

                <div class="servicio-d-flex servicio-justify-between" style="margin-top: 20px;">
                    <button type="button" class="servicio-btn servicio-btn-outline" onclick="closeCreateModal()">Cancelar</button>
                    <button type="submit" class="servicio-btn servicio-btn-primary">Guardar Categoría</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para Editar Categoría -->
<div id="editCategoryModal" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Editar Categoría</h2>
            <span class="close" onclick="closeEditModal()">&times;</span>
        </div>
        <div class="modal-body">
            <form id="editCategoryForm" action="" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_category_id" name="category_id">

                <div class="servicio-form-group">
                    <label for="edit_nombre" class="servicio-label">Nombre de la categoría</label>
                    <input type="text" id="edit_nombre" name="nombre" class="servicio-input" required>
                </div>

                <div class="servicio-form-group">
                    <label for="edit_descripcion" class="servicio-label">Descripción</label>
                    <textarea id="edit_descripcion" name="descripcion" class="servicio-textarea" rows="3"></textarea>
                </div>

                <div class="servicio-d-flex servicio-justify-between" style="margin-top: 20px;">
                    <button type="button" class="servicio-btn servicio-btn-outline" onclick="closeEditModal()">Cancelar</button>
                    <button type="submit" class="servicio-btn servicio-btn-primary">Actualizar Categoría</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para Crear Subtipo -->
<div id="createSubtipoModal" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Nuevo Subtipo</h2>
            <span class="close" onclick="closeCreateSubtipoModal()">&times;</span>
        </div>
        <div class="modal-body">
            <form id="createSubtipoForm" action="{{ route('admin.prensa.subtipos.store') }}" method="POST">
                @csrf
                <div class="servicio-form-group">
                    <label for="categoria_id" class="servicio-label">Categoría</label>
                    <select id="categoria_id" name="categoria_id" class="servicio-select" required>
                        <option value="">Seleccionar categoría</option>
                        @foreach($categorias as $categoria)
                            <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                </div>
                
                <div class="servicio-form-group">
                    <label for="nombre_subtipo" class="servicio-label">Nombre del subtipo</label>
                    <input type="text" id="nombre_subtipo" name="nombre_subtipo" class="servicio-input" required>
                </div>

                <div class="servicio-d-flex servicio-justify-between" style="margin-top: 20px;">
                    <button type="button" class="servicio-btn servicio-btn-outline" onclick="closeCreateSubtipoModal()">Cancelar</button>
                    <button type="submit" class="servicio-btn servicio-btn-primary">Guardar Subtipo</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para Editar Subtipo -->
<div id="editSubtipoModal" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Editar Subtipo</h2>
            <span class="close" onclick="closeEditSubtipoModal()">&times;</span>
        </div>
        <div class="modal-body">
            <form id="editSubtipoForm" action="" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_subtipo_id" name="subtipo_id">

                <div class="servicio-form-group">
                    <label for="edit_nombre_subtipo" class="servicio-label">Nombre del subtipo</label>
                    <input type="text" id="edit_nombre_subtipo" name="nombre_subtipo" class="servicio-input" required>
                </div>

                <div class="servicio-d-flex servicio-justify-between" style="margin-top: 20px;">
                    <button type="button" class="servicio-btn servicio-btn-outline" onclick="closeEditSubtipoModal()">Cancelar</button>
                    <button type="submit" class="servicio-btn servicio-btn-primary">Actualizar Subtipo</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Funciones para el modal de Categoría
    function openCreateModal() {
        document.getElementById('createCategoryModal').style.display = 'block';
        document.body.style.overflow = 'hidden'; // Prevenir scroll en el fondo
    }

    function closeCreateModal() {
        document.getElementById('createCategoryModal').style.display = 'none';
        document.body.style.overflow = 'auto'; // Restaurar scroll
        document.getElementById('createCategoryForm').reset();
    }

    function editCategory(id, name, description) {
        // Llenar el formulario con los datos
        document.getElementById('edit_category_id').value = id;
        document.getElementById('edit_nombre').value = name;
        document.getElementById('edit_descripcion').value = description;
        
        // Configurar la acción del formulario
        document.getElementById('editCategoryForm').action = "{{ route('admin.prensa.categorias') }}/" + id;
        
        // Mostrar el modal
        document.getElementById('editCategoryModal').style.display = 'block';
        document.body.style.overflow = 'hidden'; // Prevenir scroll en el fondo
    }

    function closeEditModal() {
        document.getElementById('editCategoryModal').style.display = 'none';
        document.body.style.overflow = 'auto'; // Restaurar scroll
        document.getElementById('editCategoryForm').reset();
    }

    function deleteCategory(id, name) {
        if (confirm(`¿Estás seguro de que deseas eliminar la categoría "${name}"? Esta acción no se puede deshacer.`)) {
            // Crear un formulario para enviar la solicitud DELETE
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = "{{ route('admin.prensa.categorias') }}/" + id;
            
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            
            const method = document.createElement('input');
            method.type = 'hidden';
            method.name = '_method';
            method.value = 'DELETE';
            
            form.appendChild(csrfToken);
            form.appendChild(method);
            document.body.appendChild(form);
            form.submit();
        }
    }

    // Funciones para el modal de Subtipo
    function openCreateSubtipoModal() {
        document.getElementById('createSubtipoModal').style.display = 'block';
        document.body.style.overflow = 'hidden'; // Prevenir scroll en el fondo
    }

    function closeCreateSubtipoModal() {
        document.getElementById('createSubtipoModal').style.display = 'none';
        document.body.style.overflow = 'auto'; // Restaurar scroll
        document.getElementById('createSubtipoForm').reset();
    }

    function editSubtipo(id, name) {
        // Llenar el formulario con los datos
        document.getElementById('edit_subtipo_id').value = id;
        document.getElementById('edit_nombre_subtipo').value = name;
        
        // Configurar la acción del formulario
        document.getElementById('editSubtipoForm').action = "{{ route('admin.prensa.subtipos.store') }}/" + id;
        
        // Mostrar el modal
        document.getElementById('editSubtipoModal').style.display = 'block';
        document.body.style.overflow = 'hidden'; // Prevenir scroll en el fondo
    }

    function closeEditSubtipoModal() {
        document.getElementById('editSubtipoModal').style.display = 'none';
        document.body.style.overflow = 'auto'; // Restaurar scroll
        document.getElementById('editSubtipoForm').reset();
    }

    function deleteSubtipo(id, name) {
        if (confirm(`¿Estás seguro de que deseas eliminar el subtipo "${name}"? Esta acción no se puede deshacer.`)) {
            // Crear un formulario para enviar la solicitud DELETE
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = "{{ route('admin.prensa.subtipos.store') }}/" + id;
            
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            
            const method = document.createElement('input');
            method.type = 'hidden';
            method.name = '_method';
            method.value = 'DELETE';
            
            form.appendChild(csrfToken);
            form.appendChild(method);
            document.body.appendChild(form);
            form.submit();
        }
    }

    // Cerrar modales al hacer clic fuera de ellos
    window.onclick = function(event) {
        if (event.target == document.getElementById('createCategoryModal')) {
            closeCreateModal();
        }
        if (event.target == document.getElementById('editCategoryModal')) {
            closeEditModal();
        }
        if (event.target == document.getElementById('createSubtipoModal')) {
            closeCreateSubtipoModal();
        }
        if (event.target == document.getElementById('editSubtipoModal')) {
            closeEditSubtipoModal();
        }
    }
</script>

<style>
    .servicio-categories-list {
        display: grid;
        gap: 1rem;
    }
    
    .servicio-category-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        border: 1px solid #e9ecef;
        border-radius: 0.5rem;
        padding: 1rem;
        transition: all 0.2s ease;
    }
    
    .servicio-category-item:hover {
        border-color: #dee2e6;
        box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
    }
    
    .servicio-category-content {
        flex: 1;
    }
    
    .servicio-category-title {
        margin: 0;
        font-size: 1.125rem;
        font-weight: 600;
        color: #FFF;
        margin-bottom: 0.25rem;
    }
    
    .servicio-category-description {
        margin: 0;
        color: #FFF;
        font-size: 0.875rem;
        margin-bottom: 0.5rem;
    }
    
    .servicio-category-meta {
        display: flex;
        gap: 0.5rem;
    }
    
    .servicio-category-actions {
        display: flex;
        gap: 0.5rem;
        align-items: center;
    }
</style>
@endsection