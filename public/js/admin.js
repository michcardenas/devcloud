document.addEventListener('DOMContentLoaded', function() {
    const servicesContainer = document.getElementById('services-container');
    const addServiceBtn = document.getElementById('addServiceBtn');
    const serviceTemplate = document.getElementById('service-template');
    
    if (!servicesContainer || !addServiceBtn || !serviceTemplate) {
        console.error('No se encontraron los elementos necesarios para la funcionalidad de servicios dinámicos');
        return;
    }
    
    // Función para actualizar los índices de los servicios
    function updateServiceIndices() {
        const services = servicesContainer.querySelectorAll('.service-item');
        
        services.forEach((service, index) => {
            // Actualizar el atributo data-index
            service.setAttribute('data-index', index);
            
            // Actualizar los nombres e IDs de los campos
            updateElementAttributes(service, 'service_title_', 'services[', index);
            updateElementAttributes(service, 'service_description_', 'services[', index);
            updateElementAttributes(service, 'service_icon_', 'services[', index);
            
            // Actualizar el campo hidden de existing_icon
            const hiddenIcon = service.querySelector('input[name^="services"][name$="[existing_icon]"]');
            if (hiddenIcon) {
                hiddenIcon.name = `services[${index}][existing_icon]`;
            }
        });
    }
    
    // Función auxiliar para actualizar atributos
    function updateElementAttributes(serviceEl, idPrefix, namePrefix, index) {
        // Actualizar input/textarea
        const element = serviceEl.querySelector(`[id^="${idPrefix}"]`);
        if (element) {
            element.id = `${idPrefix}${index}`;
            element.name = `${namePrefix}${index}][${idPrefix.replace('service_', '').slice(0, -1)}]`;
        }
        
        // Actualizar label
        const label = serviceEl.querySelector(`label[for^="${idPrefix}"]`);
        if (label) {
            label.setAttribute('for', `${idPrefix}${index}`);
        }
    }
    
    // Función para actualizar el título visible del servicio
    function updateServiceTitle(serviceEl) {
        const titleInput = serviceEl.querySelector('.service-title');
        const titleDisplay = serviceEl.querySelector('.service-title-display');
        
        if (titleInput && titleDisplay) {
            titleInput.addEventListener('input', function() {
                titleDisplay.textContent = titleInput.value || 'Nuevo servicio';
            });
        }
    }
    
    // Manejar la vista previa de iconos
    function setupIconPreview(serviceEl) {
        const iconInput = serviceEl.querySelector('.service-icon-input');
        const iconPreview = serviceEl.querySelector('.icon-preview');
        const iconTextDisplay = serviceEl.querySelector('input[readonly]');
        
        if (iconInput && iconPreview) {
            iconInput.addEventListener('change', function() {
                if (this.files && this.files[0]) {
                    const file = this.files[0];
                    const reader = new FileReader();
                    
                    reader.onload = function(e) {
                        // Crear o actualizar la imagen de vista previa
                        let img = iconPreview.querySelector('img');
                        if (!img) {
                            img = document.createElement('img');
                            img.className = 'h-10 rounded border border-gray-700';
                            img.alt = 'Vista previa de icono';
                            iconPreview.appendChild(img);
                        }
                        
                        img.src = e.target.result;
                        iconPreview.style.display = 'block';
                        
                        // Actualizar el texto del input
                        if (iconTextDisplay) {
                            iconTextDisplay.value = file.name;
                        }
                    };
                    
                    reader.readAsDataURL(file);
                }
            });
        }
    }
    
    // Agregar un nuevo servicio
    addServiceBtn.addEventListener('click', function() {
        const serviceCount = servicesContainer.querySelectorAll('.service-item').length;
        const newIndex = serviceCount;
        
        // Clonar la plantilla
        const newServiceHTML = serviceTemplate.innerHTML.replace(/__INDEX__/g, newIndex);
        
        // Crear un elemento contenedor para el nuevo servicio
        const tempDiv = document.createElement('div');
        tempDiv.innerHTML = newServiceHTML;
        const newService = tempDiv.firstElementChild;
        
        // Agregar el nuevo servicio al contenedor
        servicesContainer.appendChild(newService);
        
        // Configurar los eventos para el nuevo servicio
        setupServiceEvents(newService);
        
        // Mostrar mensaje de éxito
        showNotification('Servicio agregado correctamente', 'success');
    });
    
    // Configurar eventos para servicios existentes
    function setupServiceEvents(serviceEl) {
        // Botón de eliminar
        const deleteBtn = serviceEl.querySelector('.delete-service');
        if (deleteBtn) {
            deleteBtn.addEventListener('click', function() {
                if (servicesContainer.querySelectorAll('.service-item').length <= 1) {
                    showNotification('Debe haber al menos un servicio', 'error');
                    return;
                }
                
                if (confirm('¿Está seguro que desea eliminar este servicio?')) {
                    serviceEl.remove();
                    updateServiceIndices();
                    showNotification('Servicio eliminado', 'success');
                }
            });
        }
        
        // Botón para mostrar/ocultar detalles
        const toggleBtn = serviceEl.querySelector('.toggle-service');
        const serviceDetails = serviceEl.querySelector('.service-details');
        
        if (toggleBtn && serviceDetails) {
            toggleBtn.addEventListener('click', function() {
                const isVisible = serviceDetails.style.display !== 'none';
                serviceDetails.style.display = isVisible ? 'none' : 'grid';
                
                // Rotar el icono
                const svg = toggleBtn.querySelector('svg');
                if (svg) {
                    svg.style.transform = isVisible ? 'rotate(0deg)' : 'rotate(180deg)';
                }
            });
        }
        
        // Botones de mover arriba/abajo
        const moveUpBtn = serviceEl.querySelector('.move-service-up');
        const moveDownBtn = serviceEl.querySelector('.move-service-down');
        
        if (moveUpBtn) {
            moveUpBtn.addEventListener('click', function() {
                const prevService = serviceEl.previousElementSibling;
                if (prevService && prevService.classList.contains('service-item')) {
                    servicesContainer.insertBefore(serviceEl, prevService);
                    updateServiceIndices();
                }
            });
        }
        
        if (moveDownBtn) {
            moveDownBtn.addEventListener('click', function() {
                const nextService = serviceEl.nextElementSibling;
                if (nextService && nextService.classList.contains('service-item')) {
                    servicesContainer.insertBefore(nextService, serviceEl);
                    updateServiceIndices();
                }
            });
        }
        
        // Actualizar título al editar
        updateServiceTitle(serviceEl);
        
        // Configurar vista previa de icono
        setupIconPreview(serviceEl);
    }
    
    // Mostrar notificaciones
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
    
    // Configurar eventos para servicios existentes
    const existingServices = servicesContainer.querySelectorAll('.service-item');
    existingServices.forEach(service => {
        setupServiceEvents(service);
    });
    
    // Configurar validación del formulario
    const form = document.querySelector('form[action*="homepage.update"]');
    if (form) {
        form.addEventListener('submit', function(e) {
            // Asegurarse de que los índices estén actualizados antes de enviar
            updateServiceIndices();
            
            // Verificar que haya al menos un servicio
            if (servicesContainer.querySelectorAll('.service-item').length === 0) {
                e.preventDefault();
                showNotification('Debe agregar al menos un servicio', 'error');
                return false;
            }
            
            // Validar que todos los servicios tengan título y descripción
            let valid = true;
            const services = servicesContainer.querySelectorAll('.service-item');
            
            services.forEach((service, index) => {
                const title = service.querySelector('input[name$="[title]"]');
                const description = service.querySelector('textarea[name$="[description]"]');
                
                if (!title || !title.value.trim()) {
                    valid = false;
                    title.classList.add('border-red-500');
                    showNotification(`El servicio #${index + 1} debe tener un título`, 'error');
                } else {
                    title.classList.remove('border-red-500');
                }
                
                if (!description || !description.value.trim()) {
                    valid = false;
                    description.classList.add('border-red-500');
                    showNotification(`El servicio #${index + 1} debe tener una descripción`, 'error');
                } else {
                    description.classList.remove('border-red-500');
                }
            });
            
            if (!valid) {
                e.preventDefault();
                return false;
            }
        });
    }
});