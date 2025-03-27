@extends('layouts.admin')

@section('content')
<div class="servicio-container">
    <h1 class="servicio-title">Administración de Noticias</h1>

    <ul class="servicio-breadcrumb">
        <li class="servicio-breadcrumb-item">
            <a href="{{ route('dashboard') }}" class="servicio-breadcrumb-link">Dashboard</a>
        </li>
        <li class="servicio-breadcrumb-item">
            <span class="servicio-breadcrumb-active">Noticias</span>
        </li>
    </ul>

    <ul class="servicio-tabs">
        <li class="servicio-tab-item">
            <a href="{{ route('admin.noticias.index') }}" class="servicio-tab-link active">
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
                <h2 style="font-size: 1.2rem; margin: 0;">Listado de Noticias</h2>
                <button type="button" class="servicio-btn servicio-btn-primary" onclick="openCreateModal()">
                    <span class="servicio-btn-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                    </span>
                    Nueva Noticia
                </button>
            </div>

            <div class="table-responsive">
                <table class="servicio-table">
                    <thead>
                        <tr>
                            <th width="60">ID</th>
                            <th width="80">Imagen</th>
                            <th>Título</th>
                            <th>Categoría</th>
                            <th>Fecha</th>
                            <th width="100">Estado</th>
                            <th width="150">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($noticias as $noticia)
                        <tr>
                            <td>{{ $noticia->id }}</td>
                            <td>
                                @if($noticia->imagen)
                                <img src="{{ asset('storage/' . $noticia->imagen) }}" alt="{{ $noticia->titulo }}" class="servicio-thumbnail">
                                @else
                                <div style="width: 50px; height: 50px; background-color: rgba(0,0,0,0.2); display: flex; align-items: center; justify-content: center; border-radius: 4px;">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                        <rect x="3" y="3" width="18" height="18" rx="2" ry="2"></rect>
                                        <circle cx="8.5" cy="8.5" r="1.5"></circle>
                                        <polyline points="21 15 16 10 5 21"></polyline>
                                    </svg>
                                </div>
                                @endif
                            </td>
                            <td>{{ Str::limit($noticia->titulo, 40) }}</td>
                            <td>
                                @if($noticia->categoria)
                                <span class="servicio-badge servicio-badge-primary">{{ $noticia->categoria->nombre }}</span>
                                @else
                                <span class="servicio-badge servicio-badge-secondary">Sin categoría</span>
                                @endif
                            </td>
                            <td>{{ $noticia->fecha_publicacion->format('d/m/Y') }}</td>
                            <td>
                                @if($noticia->publicada)
                                <span class="servicio-badge servicio-badge-success">Publicada</span>
                                @else
                                <span class="servicio-badge servicio-badge-secondary">Borrador</span>
                                @endif
                            </td>
                            <td>
                                <div class="servicio-d-flex">
                                    <a href="{{ route('noticias.show', $noticia->slug) }}" target="_blank" class="servicio-btn servicio-btn-sm servicio-btn-secondary" style="margin-right: 5px;" title="Ver">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                    </a>
                                    <button type="button" class="servicio-btn servicio-btn-sm servicio-btn-primary" style="margin-right: 5px;" title="Editar" onclick="openEditModal({{ $noticia->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </button>
                                    <form action="{{ route('admin.noticias.destroy', $noticia->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta noticia?');" style="display: inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="servicio-btn servicio-btn-sm servicio-btn-danger" title="Eliminar">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                <polyline points="3 6 5 6 21 6"></polyline>
                                                <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
                                                <line x1="10" y1="11" x2="10" y2="17"></line>
                                                <line x1="14" y1="11" x2="14" y2="17"></line>
                                            </svg>
                                        </button>
                                    </form>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" style="text-align: center; padding: 2rem;">
                                <p>No hay noticias disponibles</p>
                                <button type="button" class="servicio-btn servicio-btn-primary servicio-btn-sm" onclick="openCreateModal()">
                                    <span class="servicio-btn-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="12" y1="5" x2="12" y2="19"></line>
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                        </svg>
                                    </span>
                                    Crear primera noticia
                                </button>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div style="margin-top: 20px;">
                {{ $noticias->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Modal para Crear Noticia -->
<div id="createNoticiaModal" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Nueva Noticia</h2>
            <span class="close" onclick="closeCreateModal()">&times;</span>
        </div>
        <div class="modal-body">
            <form id="createNoticiaForm" action="{{ route('admin.noticias.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="servicio-form-group">
                    <label for="titulo" class="servicio-label">Título</label>
                    <input type="text" id="titulo" name="titulo" class="servicio-input" required>
                </div>

                <div class="servicio-form-group">
                    <label for="categoria_id" class="servicio-label">Categoría</label>
                    <select id="categoria_id" name="categoria_id" class="servicio-select">
                        <option value="">Seleccionar categoría</option>
                        @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="servicio-form-group">
                    <label for="fecha_publicacion" class="servicio-label">Fecha de Publicación</label>
                    <input type="date" id="fecha_publicacion" name="fecha_publicacion" class="servicio-input" value="{{ date('Y-m-d') }}" required>
                </div>

                <div class="servicio-form-group">
                    <label for="tiempo_lectura" class="servicio-label">Tiempo de Lectura (min)</label>
                    <input type="number" id="tiempo_lectura" name="tiempo_lectura" class="servicio-input" value="5" min="1" required>
                </div>

                <div class="servicio-form-group">
                    <label for="imagen" class="servicio-label">Imagen</label>
                    <input type="file" id="imagen" name="imagen" class="servicio-input" accept="image/*">
                    <span class="servicio-helper-text">Formato recomendado: JPG, PNG. Tamaño máximo: 2MB.</span>
                </div>

                <div class="servicio-form-group">
                    <label for="contenido" class="servicio-label">Contenido</label>
                    <textarea id="contenido" name="contenido" class="servicio-textarea" rows="10" required></textarea>
                </div>

                <div class="servicio-d-flex servicio-justify-between" style="margin-top: 20px;">
                    <button type="button" class="servicio-btn servicio-btn-outline" onclick="closeCreateModal()">Cancelar</button>
                    <button type="submit" class="servicio-btn servicio-btn-primary">Guardar Noticia</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para Editar Noticia -->
<div id="editNoticiaModal" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Editar Noticia</h2>
            <span class="close" onclick="closeEditModal()">&times;</span>
        </div>
        <div class="modal-body">
            <form id="editNoticiaForm" action="" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_noticia_id" name="noticia_id">

                <div class="servicio-form-group">
                    <label for="edit_titulo" class="servicio-label">Título</label>
                    <input type="text" id="edit_titulo" name="titulo" class="servicio-input" required>
                </div>

                <div class="servicio-form-group">
                    <label for="edit_categoria_id" class="servicio-label">Categoría</label>
                    <select id="edit_categoria_id" name="categoria_id" class="servicio-select">
                        <option value="">Seleccionar categoría</option>
                        @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}">{{ $categoria->nombre }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="servicio-form-group">
                    <label for="edit_fecha_publicacion" class="servicio-label">Fecha de Publicación</label>
                    <input type="date" id="edit_fecha_publicacion" name="fecha_publicacion" class="servicio-input" required>
                </div>

                <div class="servicio-form-group">
                    <label for="edit_tiempo_lectura" class="servicio-label">Tiempo de Lectura (min)</label>
                    <input type="number" id="edit_tiempo_lectura" name="tiempo_lectura" class="servicio-input" min="1" required>
                </div>

                <div class="servicio-form-group">
                    <label class="servicio-label">Imagen Actual</label>
                    <div id="current_image_container" style="margin-bottom: 10px;">
                        <img id="current_image" src="" alt="Imagen actual" style="max-width: 200px; max-height: 150px; display: none;">
                        <p id="no_image_text" style="display: none;">No hay imagen</p>
                    </div>
                    <label for="edit_imagen" class="servicio-label">Cambiar Imagen</label>
                    <input type="file" id="edit_imagen" name="imagen" class="servicio-input" accept="image/*">
                    <span class="servicio-helper-text">Deja vacío para mantener la imagen actual.</span>
                </div>

                <div class="servicio-form-group">
                    <label for="edit_contenido" class="servicio-label">Contenido</label>
                    <textarea id="edit_contenido" name="contenido" class="servicio-textarea" rows="10" required></textarea>
                </div>

                <div class="servicio-checkbox-container">
                    <div class="servicio-switch">
                        <input type="checkbox" id="edit_publicada" name="publicada" class="servicio-switch-input">
                        <span class="servicio-switch-slider"></span>
                    </div>
                    <label for="edit_publicada" class="servicio-label" style="margin-bottom: 0;">Publicada</label>
                </div>

                <div class="servicio-d-flex servicio-justify-between" style="margin-top: 20px;">
                    <button type="button" class="servicio-btn servicio-btn-outline" onclick="closeEditModal()">Cancelar</button>
                    <button type="submit" class="servicio-btn servicio-btn-primary">Actualizar Noticia</button>
                </div>
            </form>
        </div>
    </div>
</div>


<script>
    // Inicializar el editor WYSIWYG si se usa
    document.addEventListener('DOMContentLoaded', function() {
        // Si usas un editor como TinyMCE, CKEditor, etc., inicialízalo aquí
    });

    // Modal para Crear Noticia
    function openCreateModal() {
        document.getElementById('createNoticiaModal').style.display = 'block';
        document.body.style.overflow = 'hidden'; // Prevenir scroll en el fondo
    }

    function closeCreateModal() {
        document.getElementById('createNoticiaModal').style.display = 'none';
        document.body.style.overflow = 'auto'; // Restaurar scroll
        document.getElementById('createNoticiaForm').reset();
    }

    // Modal para Editar Noticia
    function openEditModal(noticiaId) {
        // Hacer una petición AJAX para obtener los datos de la noticia
        fetch(`{{ route('admin.noticias.index') }}/${noticiaId}/edit`, {
                headers: {
                    'X-Requested-With': 'XMLHttpRequest'
                }
            })
            .then(response => response.json())
            .then(data => {
                // Llenar el formulario con los datos de la noticia
                document.getElementById('edit_noticia_id').value = data.id;
                document.getElementById('edit_titulo').value = data.titulo;
                document.getElementById('edit_categoria_id').value = data.categoria_id || '';
                document.getElementById('edit_fecha_publicacion').value = data.fecha_publicacion;
                document.getElementById('edit_tiempo_lectura').value = data.tiempo_lectura;
                document.getElementById('edit_contenido').value = data.contenido;
                document.getElementById('edit_publicada').checked = data.publicada;

                // Configurar la acción del formulario
                document.getElementById('editNoticiaForm').action = `{{ route('admin.noticias.index') }}/${data.id}`;

                // Mostrar imagen actual si existe
                if (data.imagen) {
                    document.getElementById('current_image').src = "{{ asset('storage') }}/" + data.imagen;
                    document.getElementById('current_image').style.display = 'block';
                    document.getElementById('no_image_text').style.display = 'none';
                } else {
                    document.getElementById('current_image').style.display = 'none';
                    document.getElementById('no_image_text').style.display = 'block';
                }

                // Mostrar el modal
                document.getElementById('editNoticiaModal').style.display = 'block';
                document.body.style.overflow = 'hidden'; // Prevenir scroll en el fondo
            })
            .catch(error => {
                console.error('Error al cargar la noticia:', error);
                alert('Error al cargar los datos de la noticia. Por favor, inténtalo de nuevo.');
            });
    }

    function closeEditModal() {
        document.getElementById('editNoticiaModal').style.display = 'none';
        document.body.style.overflow = 'auto'; // Restaurar scroll
        document.getElementById('editNoticiaForm').reset();
    }

    // Cerrar modales al hacer clic fuera de ellos
    window.onclick = function(event) {
        if (event.target == document.getElementById('createNoticiaModal')) {
            closeCreateModal();
        }
        if (event.target == document.getElementById('editNoticiaModal')) {
            closeEditModal();
        }
    }
</script>
@endsection