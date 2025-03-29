@extends('layouts.admin')

@section('content')
<div class="servicio-container">
    <h1 class="servicio-title">Administración de Sala de Prensa</h1>

    <ul class="servicio-breadcrumb">
        <li class="servicio-breadcrumb-item">
            <a href="{{ route('dashboard') }}" class="servicio-breadcrumb-link">Dashboard</a>
        </li>
        <li class="servicio-breadcrumb-item">
            <span class="servicio-breadcrumb-active">Sala de Prensa</span>
        </li>
    </ul>

    <ul class="servicio-tabs">
        <li class="servicio-tab-item">
            <a href="{{ route('admin.prensa.index') }}" class="servicio-tab-link active">
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
            <a href="{{ route('admin.prensa.categorias') }}" class="servicio-tab-link">
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

            <div class="servicio-d-flex servicio-justify-between servicio-align-center servicio-my-3">
                <h2 style="font-size: 1.2rem; margin: 0;">Listado de Contenidos</h2>
                <button type="button" class="servicio-btn servicio-btn-primary" onclick="openCreatePrensaModal()">
                    <span class="servicio-btn-icon">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                    </span>
                    Nuevo Contenido
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
                            <th width="100">Destacado</th>
                            <th width="150">Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($prensaItems as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>
                                @if($item->imagen)
                                <img src="{{ asset('storage/' . $item->imagen) }}" alt="{{ $item->titulo }}" class="servicio-thumbnail">
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
                            <td>{{ Str::limit($item->titulo, 40) }}</td>
                            <td>
                                <span class="servicio-badge servicio-badge-primary">{{ $item->categoria }}</span>
                            </td>
                            <td>{{ $item->fecha_formateada }}</td>
                            <td>
                                @if($item->destacado)
                                <span class="servicio-badge servicio-badge-success">Destacado</span>
                                @else
                                <span class="servicio-badge servicio-badge-secondary">Normal</span>
                                @endif
                            </td>
                            <td>
                                <div class="servicio-d-flex">
                                    <a href="{{ route('prensa.index') }}" target="_blank" class="servicio-btn servicio-btn-sm servicio-btn-secondary" style="margin-right: 5px;" title="Ver">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path>
                                            <circle cx="12" cy="12" r="3"></circle>
                                        </svg>
                                    </a>
                                    <button type="button" class="servicio-btn servicio-btn-sm servicio-btn-primary" style="margin-right: 5px;" title="Editar" onclick="openEditPrensaModal({{ $item->id }})">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                            <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                        </svg>
                                    </button>
                                    <form action="{{ route('admin.prensa.destroy', $item->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este contenido?');" style="display: inline;">
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
                                <p>No hay contenidos disponibles</p>
                                <button type="button" class="servicio-btn servicio-btn-primary servicio-btn-sm" onclick="openCreatePrensaModal()">
                                    <span class="servicio-btn-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                            <line x1="12" y1="5" x2="12" y2="19"></line>
                                            <line x1="5" y1="12" x2="19" y2="12"></line>
                                        </svg>
                                    </span>
                                    Crear primer contenido
                                </button>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            <div style="margin-top: 20px;">
                {{ $prensaItems->links() }}
            </div>

            <!-- Modal para Crear Contenido de Prensa -->
            <div id="createPrensaContentModal" class="modal" style="display: none;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2>Nuevo Contenido</h2>
                        <span class="close" onclick="closeCreatePrensaModal()">&times;</span>
                    </div>
                    <div class="modal-body">
                        <form id="createPrensaContentForm" action="{{ route('admin.prensa.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="servicio-form-group">
                                <label for="prensa_titulo" class="servicio-label">Título</label>
                                <input type="text" id="prensa_titulo" name="titulo" class="servicio-input" required>
                            </div>

                            <div class="servicio-form-group">
                                <label for="prensa_categoria" class="servicio-label">Categoría</label>
                                <select id="prensa_categoria" name="categoria" class="servicio-select" required>
                                    <option value="">Seleccionar categoría</option>
                                    @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->nombre }}">{{ $categoria->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="servicio-form-group">
                                <label for="prensa_subtipo" class="servicio-label">Subtipo</label>
                                <select id="edit_prensa_subtipo" name="subtipo" class="servicio-select">
                                    <option value="">Seleccionar subtipo</option>
                                    @foreach($subtipos as $subtipo)
                                    <option value="{{ $subtipo->nombre }}">{{ $subtipo->nombre }}</option>
                                    @endforeach
                                </select>
                                <span class="servicio-helper-text">Los subtipos disponibles se actualizarán según la categoría seleccionada</span>
                            </div>

                            <div class="servicio-form-group">
                                <label for="prensa_fecha" class="servicio-label">Fecha de Publicación</label>
                                <input type="date" id="prensa_fecha" name="fecha" class="servicio-input" value="{{ date('Y-m-d') }}" required>
                            </div>

                            <div class="servicio-form-group">
                                <label for="prensa_imagen" class="servicio-label">Imagen (opcional)</label>
                                <input type="file" id="prensa_imagen" name="imagen" class="servicio-input" accept="image/*">
                                <span class="servicio-helper-text">Formato recomendado: JPG, PNG. Tamaño máximo: 2MB.</span>
                            </div>

                            <div class="servicio-form-group">
                                <label for="prensa_descripcion" class="servicio-label">Descripción</label>
                                <textarea id="prensa_descripcion" name="descripcion" class="servicio-textarea" rows="4" required></textarea>
                                <span class="servicio-helper-text">Descripción breve que se mostrará en los listados.</span>
                            </div>

                            <div class="servicio-form-group">
                                <label for="prensa_url" class="servicio-label">URL (para enlaces externos)</label>
                                <input type="url" id="prensa_url" name="url" class="servicio-input" placeholder="https://">
                                <span class="servicio-helper-text">URL completa para "Leer artículo"</span>
                            </div>

                            <!-- Modificación para el formulario de creación -->
                            <div class="servicio-form-group">
                                <label for="prensa_pdf_url" class="servicio-label">Archivo Adjunto</label>
                                <input type="file" id="prensa_pdf_url" name="pdf_url" class="servicio-input" accept="application/pdf,application/zip,application/x-rar-compressed,application/octet-stream">
                                <span class="servicio-helper-text">Archivos soportados: PDF, ZIP, RAR. Tamaño máximo: 10MB.</span>
                            </div>

                            <div class="servicio-d-flex servicio-justify-between" style="margin-top: 20px;">
                                <button type="button" class="servicio-btn servicio-btn-outline" onclick="closeCreatePrensaModal()">Cancelar</button>
                                <button type="submit" class="servicio-btn servicio-btn-primary">Guardar Contenido</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal para Editar Contenido de Prensa -->
            <div id="editPrensaContentModal" class="modal" style="display: none;">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2>Editar Contenido</h2>
                        <span class="close" onclick="closeEditPrensaModal()">&times;</span>
                    </div>
                    <div class="modal-body">
                        <form id="editPrensaContentForm" action="" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <input type="hidden" id="edit_prensa_content_id" name="prensa_id">

                            <div class="servicio-form-group">
                                <label for="edit_prensa_titulo" class="servicio-label">Título</label>
                                <input type="text" id="edit_prensa_titulo" name="titulo" class="servicio-input" required>
                            </div>

                            <div class="servicio-form-group">
                                <label for="edit_prensa_categoria" class="servicio-label">Categoría</label>
                                <select id="edit_prensa_categoria" name="categoria" class="servicio-select" required>
                                    <option value="">Seleccionar categoría</option>
                                    @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->nombre }}">{{ $categoria->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="servicio-form-group">
                                <label for="prensa_subtipo" class="servicio-label">Subtipo</label>
                                <select id="edit_prensa_subtipo" name="subtipo" class="servicio-select">
                                    <option value="">Seleccionar subtipo</option>
                                    @foreach($subtipos as $subtipo)
                                    <option value="{{ $subtipo->nombre }}">{{ $subtipo->nombre }}</option>
                                    @endforeach
                                </select>
                                <span class="servicio-helper-text">Los subtipos disponibles se actualizarán según la categoría seleccionada</span>
                            </div>

                            <div class="servicio-form-group">
                                <label for="edit_prensa_fecha" class="servicio-label">Fecha de Publicación</label>
                                <input type="date" id="edit_prensa_fecha" name="fecha" class="servicio-input" required>
                            </div>

                            <div class="servicio-form-group">
                                <label class="servicio-label">Imagen Actual</label>
                                <div id="prensa_current_image_container" style="margin-bottom: 10px;">
                                    <img id="prensa_current_image" src="" alt="Imagen actual" style="max-width: 200px; max-height: 150px; display: none;">
                                    <p id="prensa_no_image_text" style="display: none;">No hay imagen</p>
                                </div>
                                <label for="edit_prensa_imagen" class="servicio-label">Cambiar Imagen</label>
                                <input type="file" id="edit_prensa_imagen" name="imagen" class="servicio-input" accept="image/*">
                                <span class="servicio-helper-text">Deja vacío para mantener la imagen actual.</span>
                            </div>

                            <div class="servicio-form-group">
                                <label for="edit_prensa_descripcion" class="servicio-label">Descripción</label>
                                <textarea id="edit_prensa_descripcion" name="descripcion" class="servicio-textarea" rows="4" required></textarea>
                                <span class="servicio-helper-text">Descripción breve que se mostrará en los listados.</span>
                            </div>

                            <div class="servicio-form-group">
                                <label for="edit_prensa_url" class="servicio-label">URL (para enlaces externos)</label>
                                <input type="url" id="edit_prensa_url" name="url" class="servicio-input" placeholder="https://">
                                <span class="servicio-helper-text">URL completa para "Leer artículo".</span>
                            </div>

                            <div class="servicio-form-group">
                                <label class="servicio-label">Archivo Actual</label>
                                <div id="prensa_current_pdf_container" style="margin-bottom: 10px;">
                                    <p id="prensa_current_pdf_name" style="display: none;"></p>
                                    <p id="prensa_no_pdf_text" style="display: none;">No hay archivo adjunto</p>
                                </div>
                                <label for="edit_prensa_pdf_url" class="servicio-label">Cambiar Archivo</label>
                                <input type="file" id="edit_prensa_pdf_url" name="pdf_url" class="servicio-input" accept="application/pdf,application/zip,application/x-rar-compressed,application/octet-stream">
                                <span class="servicio-helper-text">Archivos soportados: PDF, ZIP, RAR. Tamaño máximo: 10MB. Deja vacío para mantener el archivo actual.</span>
                            </div>

                            <div class="servicio-d-flex servicio-justify-between" style="margin-top: 20px;">
                                <button type="button" class="servicio-btn servicio-btn-outline" onclick="closeEditPrensaModal()">Cancelar</button>
                                <button type="submit" class="servicio-btn servicio-btn-primary">Actualizar Contenido</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    // Referencias a elementos del formulario de creación
                    const prensaCategoriaSelect = document.getElementById('prensa_categoria');
                    const prensaSubtipoSelect = document.getElementById('edit_prensa_subtipo');
                    const prensaSubtipoField = prensaSubtipoSelect ? prensaSubtipoSelect.parentElement : null;

                    if (prensaCategoriaSelect && prensaSubtipoSelect && prensaSubtipoField) {
                        prensaCategoriaSelect.addEventListener('change', function() {
                            // Siempre mostrar el campo de subtipo
                            prensaSubtipoField.style.display = 'block';

                            // Limpiar opciones actuales
                            prensaSubtipoSelect.innerHTML = '<option value="">Seleccionar subtipo</option>';

                            if (!this.value) return;

                            // Obtener ID de la categoría seleccionada
                            fetch(`/admin/prensa/categorias/by-name?nombre=${encodeURIComponent(this.value)}`)
                                .then(response => response.json())
                                .then(data => {
                                    if (data && data.id) {
                                        // Cargar subtipos de esta categoría
                                        fetch(`/admin/prensa/categorias/${data.id}/subtipos`)
                                            .then(response => response.json())
                                            .then(subtipos => {
                                                subtipos.forEach(subtipo => {
                                                    const option = document.createElement('option');
                                                    option.value = subtipo.nombre;
                                                    option.textContent = subtipo.nombre;
                                                    prensaSubtipoSelect.appendChild(option);
                                                });
                                            })
                                            .catch(error => console.error('Error al cargar subtipos:', error));
                                    }
                                })
                                .catch(error => console.error('Error al obtener ID de categoría:', error));
                        });
                    }

                    // Referencias a elementos del formulario de edición
                    const editPrensaCategoriaSelect = document.getElementById('edit_prensa_categoria');
                    const editPrensaSubtipoSelect = document.getElementById('edit_prensa_subtipo');
                    const editPrensaSubtipoField = editPrensaSubtipoSelect ? editPrensaSubtipoSelect.parentElement : null;

                    if (editPrensaCategoriaSelect && editPrensaSubtipoSelect && editPrensaSubtipoField) {
                        editPrensaCategoriaSelect.addEventListener('change', function() {
                            // Siempre mostrar el campo de subtipo
                            editPrensaSubtipoField.style.display = 'block';

                            // Limpiar opciones actuales
                            editPrensaSubtipoSelect.innerHTML = '<option value="">Seleccionar subtipo</option>';

                            if (!this.value) return;

                            // Obtener ID de la categoría seleccionada
                            fetch(`/admin/prensa/categorias/by-name?nombre=${encodeURIComponent(this.value)}`)
                                .then(response => response.json())
                                .then(data => {
                                    if (data && data.id) {
                                        // Cargar subtipos de esta categoría
                                        fetch(`/admin/prensa/categorias/${data.id}/subtipos`)
                                            .then(response => response.json())
                                            .then(subtipos => {
                                                subtipos.forEach(subtipo => {
                                                    const option = document.createElement('option');
                                                    option.value = subtipo.nombre;
                                                    option.textContent = subtipo.nombre;
                                                    editPrensaSubtipoSelect.appendChild(option);
                                                });
                                            })
                                            .catch(error => console.error('Error al cargar subtipos:', error));
                                    }
                                })
                                .catch(error => console.error('Error al obtener ID de categoría:', error));
                        });
                    }
                });

                // Modal para Crear Contenido de Prensa
                function openCreatePrensaModal() {
                    const modal = document.getElementById('createPrensaContentModal');
                    if (modal) {
                        modal.style.display = 'block';
                        document.body.style.overflow = 'hidden'; // Prevenir scroll en el fondo
                    }
                }

                function closeCreatePrensaModal() {
                    const modal = document.getElementById('createPrensaContentModal');
                    const form = document.getElementById('createPrensaContentForm');

                    if (modal) {
                        modal.style.display = 'none';
                        document.body.style.overflow = 'auto'; // Restaurar scroll
                    }

                    if (form) {
                        form.reset();
                    }
                }

                // Modal para Editar Contenido de Prensa
                function openEditPrensaModal(prensaId) {
                    // Hacer una petición AJAX para obtener los datos del contenido
                    fetch(`/admin/prensa/${prensaId}/edit`, {
                            headers: {
                                'X-Requested-With': 'XMLHttpRequest'
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            // Obtener referencias a los elementos
                            const idField = document.getElementById('edit_prensa_content_id');
                            const tituloField = document.getElementById('edit_prensa_titulo');
                            const categoriaField = document.getElementById('edit_prensa_categoria');
                            const fechaField = document.getElementById('edit_prensa_fecha');
                            const descripcionField = document.getElementById('edit_prensa_descripcion');
                            const urlField = document.getElementById('edit_prensa_url');
                            const destacadoField = document.getElementById('edit_prensa_destacado');
                            const subtipoSelect = document.getElementById('edit_prensa_subtipo');
                            const currentImage = document.getElementById('prensa_current_image');
                            const noImageText = document.getElementById('prensa_no_image_text');
                            const currentPdfName = document.getElementById('prensa_current_pdf_name');
                            const noPdfText = document.getElementById('prensa_no_pdf_text');
                            const editForm = document.getElementById('editPrensaContentForm');
                            const editModal = document.getElementById('editPrensaContentModal');

                            // Verificar que todos los elementos necesarios existen
                            if (!idField || !tituloField || !categoriaField || !fechaField ||
                                !descripcionField || !editForm || !editModal) {
                                console.error('Elementos del formulario no encontrados');
                                alert('Error al cargar el formulario. Por favor, recarga la página e inténtalo de nuevo.');
                                return;
                            }

                            // Llenar el formulario con los datos
                            idField.value = data.id;
                            tituloField.value = data.titulo;
                            categoriaField.value = data.categoria;
                            fechaField.value = data.fecha;
                            descripcionField.value = data.descripcion;

                            if (urlField) urlField.value = data.url || '';
                            if (destacadoField) destacadoField.checked = data.destacado;

                            // Cargar subtipos para esta categoría
                            if (data.categoria && subtipoSelect) {
                                fetch(`/admin/prensa/categorias/by-name?nombre=${encodeURIComponent(data.categoria)}`)
                                    .then(response => response.json())
                                    .then(catData => {
                                        if (catData && catData.id) {
                                            // Limpiar opciones actuales
                                            subtipoSelect.innerHTML = '<option value="">Seleccionar subtipo</option>';

                                            // Cargar subtipos de esta categoría
                                            fetch(`/admin/prensa/categorias/${catData.id}/subtipos`)
                                                .then(response => response.json())
                                                .then(subtipos => {
                                                    subtipos.forEach(subtipo => {
                                                        const option = document.createElement('option');
                                                        option.value = subtipo.nombre;
                                                        option.textContent = subtipo.nombre;

                                                        // Si es el subtipo actual, seleccionarlo
                                                        if (data.subtipo && subtipo.nombre === data.subtipo) {
                                                            option.selected = true;
                                                        }

                                                        subtipoSelect.appendChild(option);
                                                    });

                                                    // Mostrar campo de subtipo
                                                    if (subtipoSelect.parentElement) {
                                                        subtipoSelect.parentElement.style.display = 'block';
                                                    }
                                                })
                                                .catch(error => console.error('Error al cargar subtipos:', error));
                                        }
                                    })
                                    .catch(error => console.error('Error al obtener ID de categoría:', error));
                            }

                            // Configurar la acción del formulario
                            editForm.action = `/admin/prensa/${data.id}`;

                            // Mostrar imagen actual si existe
                            if (data.imagen && currentImage && noImageText) {
                                currentImage.src = "/storage/" + data.imagen;
                                currentImage.style.display = 'block';
                                noImageText.style.display = 'none';
                            } else if (currentImage && noImageText) {
                                currentImage.style.display = 'none';
                                noImageText.style.display = 'block';
                            }

                            // Mostrar archivo actual si existe
                            if (data.pdf_url && currentPdfName && noPdfText) {
                                const fileName = data.pdf_url.split('/').pop();
                                const extension = fileName.split('.').pop().toUpperCase();
                                const displayText = extension ? `Archivo actual (${extension}): ${fileName}` : `Archivo actual: ${fileName}`;

                                currentPdfName.textContent = displayText;
                                currentPdfName.style.display = 'block';
                                noPdfText.style.display = 'none';
                            } else if (currentPdfName && noPdfText) {
                                currentPdfName.style.display = 'none';
                                noPdfText.style.display = 'block';
                            }

                            // Mostrar el modal
                            editModal.style.display = 'block';
                            document.body.style.overflow = 'hidden'; // Prevenir scroll en el fondo
                        })
                        .catch(error => {
                            console.error('Error al cargar el contenido:', error);
                            alert('Error al cargar los datos. Por favor, inténtalo de nuevo.');
                        });
                }

                function closeEditPrensaModal() {
                    const modal = document.getElementById('editPrensaContentModal');
                    const form = document.getElementById('editPrensaContentForm');

                    if (modal) {
                        modal.style.display = 'none';
                        document.body.style.overflow = 'auto'; // Restaurar scroll
                    }

                    if (form) {
                        form.reset();
                    }
                }

                // Cerrar modales al hacer clic fuera de ellos
                window.onclick = function(event) {
                    const createModal = document.getElementById('createPrensaContentModal');
                    const editModal = document.getElementById('editPrensaContentModal');

                    if (event.target == createModal) {
                        closeCreatePrensaModal();
                    }
                    if (event.target == editModal) {
                        closeEditPrensaModal();
                    }
                };
            </script>
            @endsection