document.addEventListener('DOMContentLoaded', function() {
    // ======== Funciones para manejar modales ========
    function openCreateModal() {
        document.getElementById('createCategoriaModal').style.display = 'block';
        document.body.style.overflow = 'hidden'; // Prevenir scroll en el fondo
    }
    
    function closeCreateModal() {
        document.getElementById('createCategoriaModal').style.display = 'none';
        document.body.style.overflow = 'auto'; // Restaurar scroll
        document.getElementById('createCategoriaForm').reset();
    }
    
    function openEditModal(categoriaId) {
        // Hacer una petición AJAX para obtener los datos de la categoría
        fetch(`${window.location.pathname}/${categoriaId}/edit`, {
            headers: {
                'X-Requested-With': 'XMLHttpRequest'
            }
        })
        .then(response => response.json())
        .then(data => {
            // Llenar el formulario con los datos de la categoría
            document.getElementById('edit_categoria_id').value = data.id;
            document.getElementById('edit_nombre').value = data.nombre;
            document.getElementById('edit_icono').value = data.icono || '';
            document.getElementById('edit_activa').checked = data.activa;
            
            // Configurar la acción del formulario
            document.getElementById('editCategoriaForm').action = `${window.location.pathname}/${data.id}`;
            
            // Actualizar la vista previa del icono
            const iconoPreview = document.getElementById('icono_preview');
            if (data.icono) {
                iconoPreview.className = data.icono;
            } else {
                iconoPreview.className = 'fas fa-icons';
            }
            
            // Mostrar el modal
            document.getElementById('editCategoriaModal').style.display = 'block';
            document.body.style.overflow = 'hidden'; // Prevenir scroll en el fondo
        })
        .catch(error => {
            console.error('Error al cargar la categoría:', error);
            showNotification('Error al cargar los datos de la categoría. Por favor, inténtalo de nuevo.', 'error');
        });
    }
    
    function closeEditModal() {
        document.getElementById('editCategoriaModal').style.display = 'none';
        document.body.style.overflow = 'auto'; // Restaurar scroll
        document.getElementById('editCategoriaForm').reset();
    }
    
    function openDeleteModal(categoriaId, nombreCategoria) {
        document.getElementById('delete_categoria_nombre').textContent = nombreCategoria;
        document.getElementById('deleteCategoriaForm').action = `${window.location.pathname}/${categoriaId}`;
        document.getElementById('deleteCategoriaModal').style.display = 'block';
        document.body.style.overflow = 'hidden'; // Prevenir scroll en el fondo
    }
    
    function closeDeleteModal() {
        document.getElementById('deleteCategoriaModal').style.display = 'none';
        document.body.style.overflow = 'auto'; // Restaurar scroll
    }

    // ======== Mostrar notificaciones ========
    function showNotification(message, type = 'info') {
        // Crear elemento de notificación
        const notification = document.createElement('div');
        notification.className = `fixed top-4 right-4 px-4 py-3 rounded-lg shadow-lg z-50 ${
            type === 'success' ? 'bg-green-900 bg-opacity-20 border border-green-800 text-green-300' :
            type === 'error' ? 'bg-red-900 bg-opacity-20 border border-red-800 text-red-300' :
            'bg-blue-900 bg-opacity-20 border border-blue-800 text-blue-300'
        }`;
        
        // Ícono según el tipo
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

    // ======== Asignar eventos a botones ========
    // Botón para abrir modal de crear
    const btnNuevaCategoria = document.getElementById('btnNuevaCategoria');
    if (btnNuevaCategoria) {
        btnNuevaCategoria.addEventListener('click', openCreateModal);
    }

    // Botón alternativo para crear primera categoría (cuando no hay categorías)
    const btnPrimeraCategoria = document.getElementById('btnPrimeraCategoria');
    if (btnPrimeraCategoria) {
        btnPrimeraCategoria.addEventListener('click', openCreateModal);
    }

    // Botones para cerrar modal de crear
    const closeCreateModalBtn = document.querySelector('#createCategoriaModal .close');
    if (closeCreateModalBtn) {
        closeCreateModalBtn.addEventListener('click', closeCreateModal);
    }

    const cancelCreateBtn = document.querySelector('#createCategoriaModal button[type="button"]');
    if (cancelCreateBtn) {
        cancelCreateBtn.addEventListener('click', closeCreateModal);
    }

    // Botones para editar categorías
    const editButtons = document.querySelectorAll('.edit-categoria');
    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const categoriaId = this.getAttribute('data-id');
            openEditModal(categoriaId);
        });
    });

    // Botones para cerrar modal de editar
    const closeEditModalBtn = document.querySelector('#editCategoriaModal .close');
    if (closeEditModalBtn) {
        closeEditModalBtn.addEventListener('click', closeEditModal);
    }

    const cancelEditBtn = document.querySelector('#editCategoriaModal button[type="button"]');
    if (cancelEditBtn) {
        cancelEditBtn.addEventListener('click', closeEditModal);
    }

    // Botones para eliminar categorías
    const deleteButtons = document.querySelectorAll('.delete-categoria');
    deleteButtons.forEach(button => {
        button.addEventListener('click', function() {
            const categoriaId = this.getAttribute('data-id');
            const nombre = this.getAttribute('data-nombre');
            openDeleteModal(categoriaId, nombre);
        });
    });

    // Botones para cerrar modal de eliminar
    const closeDeleteModalBtn = document.querySelector('#deleteCategoriaModal .close');
    if (closeDeleteModalBtn) {
        closeDeleteModalBtn.addEventListener('click', closeDeleteModal);
    }

    const cancelDeleteBtn = document.querySelector('#deleteCategoriaModal button[type="button"]');
    if (cancelDeleteBtn) {
        cancelDeleteBtn.addEventListener('click', closeDeleteModal);
    }

    // ======== Configurar vista previa de iconos ========
    // Para el modal de crear
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

    // Para el modal de editar
    const editIconoInput = document.getElementById('edit_icono');
    if (editIconoInput) {
        editIconoInput.addEventListener('input', function() {
            const iconoPreview = document.getElementById('icono_preview');
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

    // ======== Cerrar modales al hacer clic fuera de ellos ========
    window.addEventListener('click', function(event) {
        const createModal = document.getElementById('createCategoriaModal');
        const editModal = document.getElementById('editCategoriaModal');
        const deleteModal = document.getElementById('deleteCategoriaModal');

        if (event.target === createModal) {
            closeCreateModal();
        } else if (event.target === editModal) {
            closeEditModal();
        } else if (event.target === deleteModal) {
            closeDeleteModal();
        }
    });

    // ======== Inicializar DataTables si está disponible ========
    if (typeof $.fn !== 'undefined' && typeof $.fn.dataTable !== 'undefined') {
        $('#dataTable').DataTable({
            language: {
                url: '//cdn.datatables.net/plug-ins/1.10.25/i18n/Spanish.json'
            }
        });
    }
});