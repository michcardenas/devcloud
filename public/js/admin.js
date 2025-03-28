document.addEventListener('DOMContentLoaded', function() {
    console.log('🚀 Iniciando solución para modales de noticias - v1.0');
    
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
    
    // ======== DEFINICIÓN DE RUTAS ========
    
    // Rutas para noticias
    const RUTAS = {
        noticia: {
            // Ruta de edición es /admin/noticias/{id}/editar
            edit: '/admin/noticias/{id}/editar',
            // Ruta de actualización es /admin/noticias/{id}
            update: '/admin/noticias/{id}'
        }
    };
    
    // ======== GESTIÓN DE MODALES ========
    
    // Función para abrir modal de NOTICIA
    function openNoticiaEditModal(noticiaId) {
        console.log('🔍 Abriendo modal para NOTICIA ID:', noticiaId);
        
        // Construir URL correcta para obtener datos
        const url = RUTAS.noticia.edit.replace('{id}', noticiaId);
        showNotification(`Cargando datos de noticia desde: ${url}`, 'info');
        
        // Realizar petición AJAX
        fetch(url, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json'
            },
            credentials: 'same-origin'
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`Error HTTP: ${response.status}`);
            }
            return response.json();
        })
        .then(data => {
            console.log('✅ Datos de noticia recibidos:', data);
            
            // Llenar formulario con datos básicos
            document.getElementById('edit_noticia_id').value = data.id;
            document.getElementById('edit_titulo').value = data.titulo;
            
            // Nuevo campo para contenido de tarjeta
            if (document.getElementById('edit_contenido_tarjeta')) {
                document.getElementById('edit_contenido_tarjeta').value = data.contenido_tarjeta || '';
            }
            
            // Categoría
            if (document.getElementById('edit_categoria_id')) {
                document.getElementById('edit_categoria_id').value = data.categoria_id || '';
            }
            
            // Fecha (con manejo de diferentes formatos)
            if (document.getElementById('edit_fecha_publicacion') && data.fecha_publicacion) {
                let fecha;
                if (typeof data.fecha_publicacion === 'string') {
                    if (data.fecha_publicacion.includes('T')) {
                        fecha = data.fecha_publicacion.split('T')[0];
                    } else {
                        const parts = data.fecha_publicacion.split(/[\/\-\.]/);
                        if (parts.length === 3) {
                            if (parts[0].length === 4) {
                                fecha = data.fecha_publicacion;
                            } else if (parts[2].length === 4) {
                                fecha = `${parts[2]}-${parts[1].padStart(2, '0')}-${parts[0].padStart(2, '0')}`;
                            }
                        }
                    }
                } else if (data.fecha_publicacion instanceof Object && data.fecha_publicacion.date) {
                    fecha = data.fecha_publicacion.date.split(' ')[0];
                }
                
                if (fecha) {
                    document.getElementById('edit_fecha_publicacion').value = fecha;
                }
            }
            
            // Otros campos de noticia
            if (document.getElementById('edit_tiempo_lectura')) {
                document.getElementById('edit_tiempo_lectura').value = data.tiempo_lectura || 5;
            }
            
            if (document.getElementById('edit_contenido')) {
                document.getElementById('edit_contenido').value = data.contenido || '';
            }
            
            if (document.getElementById('edit_publicada')) {
                document.getElementById('edit_publicada').checked = Boolean(data.publicada);
            }
            
            // Manejo de imagen
            const currentImage = document.getElementById('current_image');
            const noImageText = document.getElementById('no_image_text');
            
            if (currentImage && noImageText) {
                if (data.imagen) {
                    const storageUrl = document.querySelector('meta[name="asset-url"]')?.content || '/storage/';
                    currentImage.src = storageUrl + data.imagen;
                    currentImage.style.display = 'block';
                    noImageText.style.display = 'none';
                } else {
                    currentImage.style.display = 'none';
                    noImageText.style.display = 'block';
                }
            }
            
            // Configurar acción del formulario
            const formAction = RUTAS.noticia.update.replace('{id}', data.id);
            document.getElementById('editNoticiaForm').action = formAction;
            
            // Mostrar modal
            const modal = document.getElementById('editNoticiaModal');
            if (modal) {
                modal.style.display = 'block';
                document.body.style.overflow = 'hidden';
                showNotification('Modal de edición de noticia abierto correctamente', 'success');
            } else {
                showNotification('No se encontró el modal de edición de noticia', 'error');
            }
        })
        .catch(error => {
            console.error('❌ Error al cargar datos de noticia:', error);
            showNotification(`Error: ${error.message}`, 'error');
        });
    }
    
    // Función para cerrar modal de NOTICIA
    function closeNoticiaEditModal() {
        const modal = document.getElementById('editNoticiaModal');
        if (modal) {
            modal.style.display = 'none';
            document.body.style.overflow = 'auto';
            
            // Reiniciar formulario
            const form = document.getElementById('editNoticiaForm');
            if (form) {
                form.reset();
                
                // Restablecer vista previa de imagen
                const currentImage = document.getElementById('current_image');
                const noImageText = document.getElementById('no_image_text');
                
                if (currentImage && noImageText) {
                    currentImage.style.display = 'none';
                    noImageText.style.display = 'none';
                }
            }
        }
    }
    
    // ======== CONFIGURACIÓN DE BOTONES ========
    
    // Función para configurar botones de NOTICIA
    function setupNoticiaButtons() {
        console.log('🔄 Configurando botones de noticia...');
        
        // Botones con onclick para editar noticia
        const editButtons = document.querySelectorAll('button[onclick*="openEditModal"]');
        console.log(`Encontrados ${editButtons.length} botones con onclick para editar noticia`);
        
        editButtons.forEach(button => {
            // Extraer ID del onclick
            const onclick = button.getAttribute('onclick') || '';
            const match = onclick.match(/openEditModal\(\s*(\d+)\s*\)/);
            
            if (!match || !match[1]) {
                console.warn('⚠️ No se pudo extraer ID del onclick:', onclick);
                return;
            }
            
            const noticiaId = match[1];
            
            // Clonar y reemplazar para eliminar onclick
            const clonedButton = button.cloneNode(true);
            clonedButton.removeAttribute('onclick');
            button.parentNode.replaceChild(clonedButton, button);
            
            // Agregar nuevo evento
            clonedButton.addEventListener('click', function(e) {
                e.preventDefault();
                openNoticiaEditModal(noticiaId);
            });
            
            console.log(`✅ Configurado botón para noticia ID: ${noticiaId}`);
        });
        
        // Configurar botones de cerrar modal
        const closeEditBtn = document.querySelector('#editNoticiaModal .close');
        if (closeEditBtn) {
            closeEditBtn.removeAttribute('onclick');
            closeEditBtn.addEventListener('click', closeNoticiaEditModal);
        }
        
        const cancelEditBtn = document.querySelector('#editNoticiaModal button[onclick="closeEditModal()"]');
        if (cancelEditBtn) {
            cancelEditBtn.removeAttribute('onclick');
            cancelEditBtn.addEventListener('click', closeNoticiaEditModal);
        }
    }
    
    // ======== CERRAR MODALES AL HACER CLIC FUERA ========
    
    // Configurar cierre de modales al hacer clic fuera
    function setupOutsideClickClose() {
        window.addEventListener('click', function(event) {
            // Modal de noticia
            if (event.target === document.getElementById('editNoticiaModal')) {
                closeNoticiaEditModal();
            }
        });
    }
    
    // ======== EXPONER FUNCIONES GLOBALMENTE ========
    
    // Exponer funciones para que puedan ser llamadas desde HTML o console
    window.openEditModal = openNoticiaEditModal; // Compatible con código existente
    window.closeEditModal = closeNoticiaEditModal; // Compatible con código existente
    
    // ======== INICIALIZAR ========
    
    // Configurar todos los botones
    setupNoticiaButtons();
    setupOutsideClickClose();
    
    // Agregar botón de emergencia para re-configurar
    const fixButton = document.createElement('button');
    fixButton.textContent = 'Reiniciar botones';
    fixButton.className = 'fixed bottom-4 right-4 px-4 py-2 bg-green-600 text-white rounded shadow';
    fixButton.style.zIndex = '9999';
    fixButton.addEventListener('click', function() {
        setupNoticiaButtons();
        showNotification('Todos los botones han sido reconfigurados', 'success');
    });
    document.body.appendChild(fixButton);
    
    console.log('✅ Solución para modales de noticias inicializada correctamente');
});