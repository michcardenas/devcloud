<input type="hidden" name="section" value="contact">@extends('layouts.admin')

@section('content')
<div class="servicio-container">
    <h1 class="servicio-title">Configuración de Contacto y FAQs</h1>

    <ul class="servicio-breadcrumb">
        <li class="servicio-breadcrumb-item">
            <a href="{{ route('dashboard') }}" class="servicio-breadcrumb-link">Dashboard</a>
        </li>
        <li class="servicio-breadcrumb-item">
            <span class="servicio-breadcrumb-active">Configuración de Contacto</span>
        </li>
    </ul>

    <ul class="servicio-tabs">
        <li class="servicio-tab-item">
            <a href="{{ route('admin.contacto.index') }}" class="servicio-tab-link active">
                <span class="servicio-tab-icon">
                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M4 4h16c1.1 0 2 .9 2 2v12c0 1.1-.9 2-2 2H4c-1.1 0-2-.9-2-2V6c0-1.1.9-2 2-2z"></path>
                        <polyline points="22,6 12,13 2,6"></polyline>
                    </svg>
                </span>
                Mensajes
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

            <form action="{{ route('admin.contacto.update') }}" method="POST">
                @csrf
                @method('PUT')
                
                <!-- Sección Hablemos de tu proyecto -->
                <div class="servicio-card mb-4">
                    <div class="servicio-card-header">
                        <h2 class="servicio-card-title">Sección principal de contacto</h2>
                    </div>
                    <div class="servicio-card-body">
                        <div class="servicio-preview-section" style="background-color: #0a2635; color: white; padding: 20px; border-radius: 8px; margin-bottom: 20px; text-align: center;">
                            <span class="servicio-badge servicio-badge-primary" style="margin-bottom: 15px;">{{ $content->contact_tag ?? 'Contacto' }}</span>
                            <h3 style="color: white; margin-bottom: 15px;">{{ $content->contact_title ?? 'Hablemos de tu proyecto' }}</h3>
                            <p style="color: #ccc;">{{ $content->contact_description ?? 'Estamos aquí para ayudarte. Contáctanos y descubre cómo nuestras soluciones tecnológicas pueden transformar tu negocio.' }}</p>
                        </div>
                        
                        <div class="servicio-form-group">
                            <label for="contact_tag" class="servicio-label">Texto del botón</label>
                            <input type="text" class="servicio-input" id="contact_tag" name="contact_tag" value="{{ $content->contact_tag ?? 'Contacto' }}">
                        </div>
                        
                        <div class="servicio-form-group">
                            <label for="contact_title" class="servicio-label">Título</label>
                            <input type="text" class="servicio-input" id="contact_title" name="contact_title" value="{{ $content->contact_title ?? 'Hablemos de tu proyecto' }}">
                        </div>
                        
                        <div class="servicio-form-group">
                            <label for="contact_description" class="servicio-label">Descripción</label>
                            <textarea class="servicio-textarea" id="contact_description" name="contact_description" rows="3">{{ $content->contact_description ?? 'Estamos aquí para ayudarte. Contáctanos y descubre cómo nuestras soluciones tecnológicas pueden transformar tu negocio.' }}</textarea>
                        </div>
                        
                        <div class="servicio-form-group">
                            <label for="contact_email" class="servicio-label">Email de contacto</label>
                            <input type="email" class="servicio-input" id="contact_email" name="contact_email" value="{{ $content->contact_email ?? '' }}">
                        </div>
                        
                        <div class="servicio-form-group">
                            <label for="contact_phone" class="servicio-label">Teléfono de contacto</label>
                            <input type="text" class="servicio-input" id="contact_phone" name="contact_phone" value="{{ $content->contact_phone ?? '' }}">
                        </div>
                        
                        <div class="servicio-form-group">
                            <label for="contact_address" class="servicio-label">Dirección</label>
                            <input type="text" class="servicio-input" id="contact_address" name="contact_address" value="{{ $content->contact_address ?? '' }}">
                        </div>
                    </div>
                </div>
                
                <!-- Sección Resolvemos tus dudas -->
                <div class="servicio-card mb-4">
                    <div class="servicio-card-header">
                        <h2 class="servicio-card-title">Sección de preguntas frecuentes</h2>
                    </div>
                    <div class="servicio-card-body">
                        <div class="servicio-preview-section" style="background-color: #0a2635; color: white; padding: 20px; border-radius: 8px; margin-bottom: 20px; text-align: center;">
                            <span class="servicio-badge servicio-badge-primary" style="margin-bottom: 15px;">{{ $content->faq_button_text ?? 'Preguntas frecuentes' }}</span>
                            <h3 style="color: white; margin-bottom: 15px;">{{ $content->faq_title ?? 'Resolvemos tus dudas' }}</h3>
                            <p style="color: #ccc;">{{ $content->faq_description ?? 'Aquí encontrarás respuestas a las preguntas más comunes sobre nuestros servicios.' }}</p>
                        </div>
                        
                        <div class="servicio-form-group">
                            <label for="faq_button_text" class="servicio-label">Texto del botón</label>
                            <input type="text" class="servicio-input" id="faq_button_text" name="faq_button_text" value="{{ $content->faq_button_text ?? 'Preguntas frecuentes' }}">
                        </div>
                        
                        <div class="servicio-form-group">
                            <label for="faq_title" class="servicio-label">Título</label>
                            <input type="text" class="servicio-input" id="faq_title" name="faq_title" value="{{ $content->faq_title ?? 'Resolvemos tus dudas' }}">
                        </div>
                        
                        <div class="servicio-form-group">
                            <label for="faq_description" class="servicio-label">Descripción</label>
                            <textarea class="servicio-textarea" id="faq_description" name="faq_description" rows="3">{{ $content->faq_description ?? 'Aquí encontrarás respuestas a las preguntas más comunes sobre nuestros servicios.' }}</textarea>
                        </div>
                    </div>
                </div>
                
                <div class="servicio-d-flex servicio-justify-end">
                    <button type="submit" class="servicio-btn servicio-btn-primary">Guardar cambios</button>
                </div>
            </form>
            
            <!-- Gestión de FAQs -->
            <div class="servicio-card" style="margin-top: 30px;">
                <div class="servicio-card-header servicio-d-flex servicio-justify-between servicio-align-center">
                    <h2 class="servicio-card-title">Listado de preguntas frecuentes</h2>
                    <button type="button" class="servicio-btn servicio-btn-sm servicio-btn-primary" onclick="openCreateFaqModal()">
                        <span class="servicio-btn-icon">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                        </span>
                        Añadir pregunta
                    </button>
                </div>
                <div class="servicio-card-body">
                    <div class="table-responsive">
                        <table class="servicio-table">
                            <thead>
                                <tr>
                                    <th width="50">ID</th>
                                    <th>Pregunta</th>
                                    <th>Respuesta</th>
                                    <th width="100">Categoría</th>
                                    <th width="80">Orden</th>
                                    <th width="100">Estado</th>
                                    <th width="120">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($faqs ?? [] as $faq)
                                <tr>
                                    <td>{{ $faq->id }}</td>
                                    <td>{{ Str::limit($faq->pregunta, 40) }}</td>
                                    <td>{{ Str::limit($faq->respuesta, 60) }}</td>
                                    <td>
                                        @if($faq->categoria)
                                        <span class="servicio-badge servicio-badge-info">{{ $faq->categoria }}</span>
                                        @else
                                        <span class="servicio-badge servicio-badge-secondary">General</span>
                                        @endif
                                    </td>
                                    <td class="text-center">{{ $faq->orden }}</td>
                                    <td>
                                        @if($faq->activo)
                                        <span class="servicio-badge servicio-badge-success">Activo</span>
                                        @else
                                        <span class="servicio-badge servicio-badge-secondary">Inactivo</span>
                                        @endif
                                    </td>
                                    <td>
                                        <div class="servicio-d-flex">
                                            <button type="button" class="servicio-btn servicio-btn-sm servicio-btn-primary" style="margin-right: 5px;" title="Editar" onclick="openEditFaqModal({{ $faq->id }})">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path>
                                                    <path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path>
                                                </svg>
                                            </button>
                                            <form action="{{ route('admin.contacto.faqs.destroy', $faq->id ?? 1) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar esta pregunta?');" style="display: inline;">
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
                                        <p>No hay preguntas frecuentes registradas</p>
                                        <button type="button" class="servicio-btn servicio-btn-primary servicio-btn-sm" onclick="openCreateFaqModal()">
                                            <span class="servicio-btn-icon">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                                                    <line x1="12" y1="5" x2="12" y2="19"></line>
                                                    <line x1="5" y1="12" x2="19" y2="12"></line>
                                                </svg>
                                            </span>
                                            Añadir primera pregunta
                                        </button>
                                    </td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                    
                    @if(isset($faqs) && $faqs->count() > 0)
                    <div style="margin-top: 20px;">
                        {{ $faqs->links() }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal para Crear FAQ -->
<div id="createFaqModal" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Nueva Pregunta Frecuente</h2>
            <span class="close" onclick="closeCreateFaqModal()">&times;</span>
        </div>
        <div class="modal-body">
            <form id="createFaqForm" action="{{ route('admin.contacto.faqs.store') }}" method="POST">
                @csrf
                <div class="servicio-form-group">
                    <label for="pregunta" class="servicio-label">Pregunta</label>
                    <input type="text" id="pregunta" name="pregunta" class="servicio-input" required>
                </div>
                
                <div class="servicio-form-group">
                    <label for="respuesta" class="servicio-label">Respuesta</label>
                    <textarea id="respuesta" name="respuesta" class="servicio-textarea" rows="4" required></textarea>
                </div>
                
                <div class="servicio-form-group">
                    <label for="categoria" class="servicio-label">Categoría</label>
                    <input type="text" id="categoria" name="categoria" class="servicio-input">
                    <small class="servicio-helper-text">Opcional. Permite agrupar preguntas relacionadas.</small>
                </div>
                
                <div class="servicio-row">
                    <div class="servicio-col-md-6">
                        <div class="servicio-form-group">
                            <label for="orden" class="servicio-label">Orden</label>
                            <input type="number" id="orden" name="orden" class="servicio-input" value="{{ ($faqs->max('orden') ?? 0) + 1 }}" min="1">
                        </div>
                    </div>
                    <div class="servicio-col-md-6">
                        <div class="servicio-form-group">
                            <div class="servicio-checkbox-wrapper" style="margin-top: 30px;">
                                <input type="checkbox" id="activo" name="activo" class="servicio-checkbox" checked>
                                <label for="activo" class="servicio-checkbox-label">Activo</label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="servicio-d-flex servicio-justify-between" style="margin-top: 20px;">
                    <button type="button" class="servicio-btn servicio-btn-outline" onclick="closeCreateFaqModal()">Cancelar</button>
                    <button type="submit" class="servicio-btn servicio-btn-primary">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal para Editar FAQ -->
<div id="editFaqModal" class="modal" style="display: none;">
    <div class="modal-content">
        <div class="modal-header">
            <h2>Editar Pregunta Frecuente</h2>
            <span class="close" onclick="closeEditFaqModal()">&times;</span>
        </div>
        <div class="modal-body">
            <form id="editFaqForm" action="" method="POST">
                @csrf
                @method('PUT')
                <input type="hidden" id="edit_faq_id" name="faq_id">
                
                <div class="servicio-form-group">
                    <label for="edit_pregunta" class="servicio-label">Pregunta</label>
                    <input type="text" id="edit_pregunta" name="pregunta" class="servicio-input" required>
                </div>
                
                <div class="servicio-form-group">
                    <label for="edit_respuesta" class="servicio-label">Respuesta</label>
                    <textarea id="edit_respuesta" name="respuesta" class="servicio-textarea" rows="4" required></textarea>
                </div>
                
                <div class="servicio-form-group">
                    <label for="edit_categoria" class="servicio-label">Categoría</label>
                    <input type="text" id="edit_categoria" name="categoria" class="servicio-input">
                    <small class="servicio-helper-text">Opcional. Permite agrupar preguntas relacionadas.</small>
                </div>
                
                <div class="servicio-row">
                    <div class="servicio-col-md-6">
                        <div class="servicio-form-group">
                            <label for="edit_orden" class="servicio-label">Orden</label>
                            <input type="number" id="edit_orden" name="orden" class="servicio-input" min="1">
                        </div>
                    </div>
                    <div class="servicio-col-md-6">
                        <div class="servicio-form-group">
                            <div class="servicio-checkbox-wrapper" style="margin-top: 30px;">
                                <input type="checkbox" id="edit_activo" name="activo" class="servicio-checkbox">
                                <label for="edit_activo" class="servicio-checkbox-label">Activo</label>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="servicio-d-flex servicio-justify-between" style="margin-top: 20px;">
                    <button type="button" class="servicio-btn servicio-btn-outline" onclick="closeEditFaqModal()">Cancelar</button>
                    <button type="submit" class="servicio-btn servicio-btn-primary">Actualizar</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    // Modal para Crear FAQ
    function openCreateFaqModal() {
    const modal = document.getElementById('createFaqModal');
    
    // Primero hacer visible el modal
    modal.style.display = 'block';
    
    // Luego desplazar la página hasta el modal
    const modalOffset = modal.getBoundingClientRect().top + window.pageYOffset;
    window.scrollTo({
        top: modalOffset - 100, // Restamos 100px para dar algo de espacio arriba
        behavior: 'smooth' // Para un desplazamiento suave
    });
    
    document.body.style.overflow = 'hidden'; // Prevenir scroll en el fondo
}
    function closeCreateFaqModal() {
        document.getElementById('createFaqModal').style.display = 'none';
        document.body.style.overflow = 'auto'; // Restaurar scroll
        document.getElementById('createFaqForm').reset();
    }

    function openEditFaqModal(faqId) {
    // Hacer una petición AJAX para obtener los datos de la pregunta
    fetch(`{{ route('admin.contacto.index') }}/faqs/${faqId}/edit`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            // Llenar el formulario con los datos...
            document.getElementById('edit_faq_id').value = data.id;
            document.getElementById('edit_pregunta').value = data.pregunta;
            document.getElementById('edit_respuesta').value = data.respuesta;
            document.getElementById('edit_categoria').value = data.categoria || '';
            document.getElementById('edit_orden').value = data.orden;
            document.getElementById('edit_activo').checked = data.activo;
            
            // Configurar la acción del formulario
            document.getElementById('editFaqForm').action = `{{ route('admin.contacto.faqs.update', '') }}/${data.id}`;

            // Mostrar el modal
            const modal = document.getElementById('editFaqModal');
            modal.style.display = 'block';
            
            // Desplazar la página hasta el modal
            const modalOffset = modal.getBoundingClientRect().top + window.pageYOffset;
            window.scrollTo({
                top: modalOffset - 100,
                behavior: 'smooth'
            });
            
            document.body.style.overflow = 'hidden';
        })
        .catch(error => {
            console.error('Error al cargar la pregunta:', error);
            alert('Error al cargar los datos de la pregunta. Por favor, inténtalo de nuevo.');
        });
}

    function closeEditFaqModal() {
        document.getElementById('editFaqModal').style.display = 'none';
        document.body.style.overflow = 'auto'; // Restaurar scroll
        document.getElementById('editFaqForm').reset();
    }

    // Cerrar modales al hacer clic fuera de ellos
    window.onclick = function(event) {
        if (event.target == document.getElementById('createFaqModal')) {
            closeCreateFaqModal();
        }
        if (event.target == document.getElementById('editFaqModal')) {
            closeEditFaqModal();
        }
    }
    
    // Función para previsualizar cambios en tiempo real (opcional, requiere JavaScript)
    document.addEventListener('DOMContentLoaded', function() {
        // Actualizar previsualización de Contacto
        const contactTag = document.getElementById('contact_tag');
        const contactTitle = document.getElementById('contact_title');
        const contactDescription = document.getElementById('contact_description');
        
        if (contactTag && contactTitle && contactDescription) {
            contactTag.addEventListener('input', updateContactPreview);
            contactTitle.addEventListener('input', updateContactPreview);
            contactDescription.addEventListener('input', updateContactPreview);
        }
        
        function updateContactPreview() {
            const previewTag = document.querySelector('.servicio-preview-section:first-of-type .servicio-badge');
            const previewTitle = document.querySelector('.servicio-preview-section:first-of-type h3');
            const previewDesc = document.querySelector('.servicio-preview-section:first-of-type p');
            
            if (previewTag && previewTitle && previewDesc) {
                previewTag.textContent = contactTag.value;
                previewTitle.textContent = contactTitle.value;
                previewDesc.textContent = contactDescription.value;
            }
        }
        
        // Actualizar previsualización de FAQs
        const faqButtonText = document.getElementById('faq_button_text');
        const faqTitle = document.getElementById('faq_title');
        const faqDescription = document.getElementById('faq_description');
        
        if (faqButtonText && faqTitle && faqDescription) {
            faqButtonText.addEventListener('input', updateFaqPreview);
            faqTitle.addEventListener('input', updateFaqPreview);
            faqDescription.addEventListener('input', updateFaqPreview);
        }
        
        function updateFaqPreview() {
            const previewTag = document.querySelector('.servicio-preview-section:nth-of-type(2) .servicio-badge');
            const previewTitle = document.querySelector('.servicio-preview-section:nth-of-type(2) h3');
            const previewDesc = document.querySelector('.servicio-preview-section:nth-of-type(2) p');
            
            if (previewTag && previewTitle && previewDesc) {
                previewTag.textContent = faqButtonText.value;
                previewTitle.textContent = faqTitle.value;
                previewDesc.textContent = faqDescription.value;
            }
        }
    });
</script>
@endsection