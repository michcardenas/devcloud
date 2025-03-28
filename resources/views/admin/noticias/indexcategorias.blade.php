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
            <a href="{{ route('admin.tags.index') }}" class="servicio-tab-link">
                <span class="servicio-tab-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M9 5H2v7l6.29 6.29c.94.94 2.48.94 3.42 0l3.58-3.58c.94-.94.94-2.48 0-3.42L9 5Z"></path>
                        <path d="M6 9.01V9"></path>
                    </svg>
                </span>
                Tags
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

<script>
 document.addEventListener('DOMContentLoaded', function() {
    console.log('🔧 Inicializando gestor de categorías');
    
    // ======== UTILIDADES ========
    
    // Función para mostrar notificaciones informativas
    function showNotification(message, type = 'info') {
        console.log(`[${type.toUpperCase()}] ${message}`);
        
        // Crear elemento de notificación
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 px-4 py-3 rounded-lg shadow-lg z-50 ${
            type === 'success' ? 'bg-green-900 bg-opacity-20 border border-green-800 text-green-300' :
            type === 'error' ? 'bg-red-900 bg-opacity-20 border border-red-800 text-red-300' :
            'bg-blue-900 bg-opacity-20 border border-blue-800 text-blue-300'
        }`;
        
        // Icono según el tipo
        let icon = '';
        if (type === 'success') {
            icon = '<svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path></svg>';
        } else if (type === 'error') {
            icon = '<svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>';
        } else {
            icon = '<svg class="w-5 h-5 inline-block mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path></svg>';
        }
        
        notification.innerHTML = `${icon}${message}`;
        document.body.appendChild(notification);
        
        // Remover después de 3 segundos
        setTimeout(() => {
            notification.style.opacity = '0';
            notification.style.transition = 'opacity 0.5s ease';
            
            setTimeout(() => {
                notification.remove();
            }, 500);
        }, 3000);
    }
    
    // ======== RUTAS PARA CATEGORÍAS ========
    
    const CATEGORIA_ROUTES = {
        // Ruta para editar categoría
        edit: '/admin/categorias/{id}/editar',
        // Ruta para actualizar categoría
        update: '/admin/categorias/{id}'
    };
    
    // ======== GESTIÓN DE MODALES DE CATEGORÍAS ========
    
    // Función para abrir modal de creación de categoría
    function openCreateCategoriaModal() {
        const modal = document.getElementById('createCategoriaModal');
        if (modal) {
            modal.style.display = 'block';
            document.body.style.overflow = 'hidden';
        }
    }
    
    // Función para cerrar modal de creación de categoría
    function closeCreateCategoriaModal() {
        const modal = document.getElementById('createCategoriaModal');
        if (modal) {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
            
            // Reiniciar formulario
            const form = document.getElementById('createCategoriaForm');
            if (form) {
                form.reset();
            }
        }
    }
    
    // Función para abrir modal de edición de categoría
    function openEditCategoriaModal(categoriaId, nombre, icono, activa) {
        console.log('🔍 Abriendo modal para CATEGORÍA ID:', categoriaId);
        
        // Llenar formulario con datos directamente desde los atributos data-*
        document.getElementById('edit_categoria_id').value = categoriaId;
        document.getElementById('edit_nombre').value = nombre || '';
        
        // Campo icono si existe
        if (document.getElementById('edit_icono')) {
            document.getElementById('edit_icono').value = icono || '';
        }
        
        // Campo activa
        if (document.getElementById('edit_activa')) {
            document.getElementById('edit_activa').checked = activa === '1';
        }
        
        // Previsualización de icono si existe
        const iconoPreview = document.getElementById('edit_icono_preview');
        if (iconoPreview) {
            iconoPreview.className = icono || 'fas fa-icons';
        }
        
        // Configurar acción del formulario
        const formAction = CATEGORIA_ROUTES.update.replace('{id}', categoriaId);
        document.getElementById('editCategoriaForm').action = formAction;
        
        // Mostrar modal
        const modal = document.getElementById('editCategoriaModal');
        if (modal) {
            modal.style.display = 'block';
            document.body.style.overflow = 'hidden';
            showNotification('Modal de edición de categoría abierto', 'success');
        } else {
            showNotification('No se encontró el modal de edición de categoría', 'error');
        }
    }
    
    // Función para cerrar modal de edición de categoría
    function closeEditCategoriaModal() {
        const modal = document.getElementById('editCategoriaModal');
        if (modal) {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
            
            // Reiniciar formulario
            const form = document.getElementById('editCategoriaForm');
            if (form) {
                form.reset();
            }
        }
    }
    
    // Función para abrir modal de eliminación de categoría
    function openDeleteCategoriaModal(categoriaId, nombre) {
        // Configurar modal de eliminación
        const nombreElement = document.getElementById('delete_categoria_nombre');
        if (nombreElement) {
            nombreElement.textContent = nombre || 'esta categoría';
        }
        
        // Establecer acción del formulario
        const formAction = CATEGORIA_ROUTES.update.replace('{id}', categoriaId);
        const form = document.getElementById('deleteCategoriaForm');
        if (form) {
            form.action = formAction;
        }
        
        // Mostrar modal
        const modal = document.getElementById('deleteCategoriaModal');
        if (modal) {
            modal.style.display = 'block';
            document.body.style.overflow = 'hidden';
        }
    }
    
    // Función para cerrar modal de eliminación de categoría
    function closeDeleteCategoriaModal() {
        const modal = document.getElementById('deleteCategoriaModal');
        if (modal) {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
        }
    }
    
    // ======== CONFIGURACIÓN DE BOTONES DE CATEGORÍAS ========
    
    // Configurar botón para nueva categoría
    const btnNuevaCategoria = document.getElementById('btnNuevaCategoria');
    if (btnNuevaCategoria) {
        btnNuevaCategoria.addEventListener('click', openCreateCategoriaModal);
    }
    
    // Configurar botón alternativo para primera categoría
    const btnPrimeraCategoria = document.getElementById('btnPrimeraCategoria');
    if (btnPrimeraCategoria) {
        btnPrimeraCategoria.addEventListener('click', openCreateCategoriaModal);
    }
    
    // Configurar botones para cerrar modal de crear
    const closeCreateBtn = document.getElementById('closeCreateModal');
    if (closeCreateBtn) {
        closeCreateBtn.addEventListener('click', closeCreateCategoriaModal);
    }
    
    const cancelCreateBtn = document.getElementById('cancelCreateBtn');
    if (cancelCreateBtn) {
        cancelCreateBtn.addEventListener('click', closeCreateCategoriaModal);
    }
    
    // Configurar botones de editar categoría
    const editButtons = document.querySelectorAll('.btn-editar-categoria');
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const categoriaId = this.getAttribute('data-id');
            const nombre = this.getAttribute('data-nombre');
            const icono = this.getAttribute('data-icono');
            const activa = this.getAttribute('data-activa');
            
            if (categoriaId) {
                openEditCategoriaModal(categoriaId, nombre, icono, activa);
            } else {
                console.warn('⚠️ Botón sin atributo data-id:', this);
            }
        });
    });
    
    // Configurar botones para cerrar modal de editar
    const closeEditBtn = document.getElementById('closeEditModal');
    if (closeEditBtn) {
        closeEditBtn.addEventListener('click', closeEditCategoriaModal);
    }
    
    const cancelEditBtn = document.getElementById('cancelEditBtn');
    if (cancelEditBtn) {
        cancelEditBtn.addEventListener('click', closeEditCategoriaModal);
    }
    
    // Configurar botones de eliminar categoría
    const deleteButtons = document.querySelectorAll('.btn-eliminar-categoria');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const categoriaId = this.getAttribute('data-id');
            const nombre = this.getAttribute('data-nombre');
            
            if (categoriaId) {
                openDeleteCategoriaModal(categoriaId, nombre);
            } else {
                console.warn('⚠️ Botón de eliminar sin atributo data-id:', this);
            }
        });
    });
    
    // Configurar botones para cerrar modal de eliminar
    const closeDeleteBtn = document.getElementById('closeDeleteModal');
    if (closeDeleteBtn) {
        closeDeleteBtn.addEventListener('click', closeDeleteCategoriaModal);
    }
    
    const cancelDeleteBtn = document.getElementById('cancelDeleteBtn');
    if (cancelDeleteBtn) {
        cancelDeleteBtn.addEventListener('click', closeDeleteCategoriaModal);
    }
    
    // Configurar vista previa de iconos
    const iconoInput = document.getElementById('icono');
    if (iconoInput) {
        iconoInput.addEventListener('input', function() {
            const iconoPreview = document.querySelector('#createCategoriaModal .servicio-input-prepend i');
            if (iconoPreview) {
                const iconClasses = this.value.trim();
                if (iconClasses) {
                    iconoPreview.className = iconClasses;
                } else {
                    iconoPreview.className = 'fas fa-icons';
                }
            }
        });
    }
    
    const editIconoInput = document.getElementById('edit_icono');
    if (editIconoInput) {
        editIconoInput.addEventListener('input', function() {
            const iconoPreview = document.getElementById('edit_icono_preview');
            if (iconoPreview) {
                const iconClasses = this.value.trim();
                if (iconClasses) {
                    iconoPreview.className = iconClasses;
                } else {
                    iconoPreview.className = 'fas fa-icons';
                }
            }
        });
    }
    
    // ======== CERRAR MODALES AL HACER CLIC FUERA ========
    
    window.addEventListener('click', function(event) {
        const createModal = document.getElementById('createCategoriaModal');
        const editModal = document.getElementById('editCategoriaModal');
        const deleteModal = document.getElementById('deleteCategoriaModal');
        
        if (event.target === createModal) {
            closeCreateCategoriaModal();
        } else if (event.target === editModal) {
            closeEditCategoriaModal();
        } else if (event.target === deleteModal) {
            closeDeleteCategoriaModal();
        }
    });
    
    // ======== EXPONER FUNCIONES GLOBALMENTE ========
    
    // Exponer funciones para que puedan ser llamadas desde HTML o console
    window.openCreateCategoriaModal = openCreateCategoriaModal;
    window.closeCreateCategoriaModal = closeCreateCategoriaModal;
    window.openEditCategoriaModal = openEditCategoriaModal;
    window.closeEditCategoriaModal = closeEditCategoriaModal;
    window.openDeleteCategoriaModal = openDeleteCategoriaModal;
    window.closeDeleteCategoriaModal = closeDeleteCategoriaModal;
    
    // ======== INICIALIZAR DATATABLES ========
    
    // Inicializar DataTables si está disponible
    if (typeof $.fn !== 'undefined' && typeof $.fn.dataTable !== 'undefined') {
        const categoriasTable = document.getElementById('dataTable');
        if (categoriasTable) {
            $('#dataTable').DataTable({
                language: {
                    url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
                }
            });
        }
    }
    
    console.log('✅ Gestor de categorías inicializado correctamente');
});
    </script>
@endsection