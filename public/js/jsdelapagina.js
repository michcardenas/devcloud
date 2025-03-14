document.addEventListener('DOMContentLoaded', function() {
    // Preparar elementos para animaciones
    function setupAnimations() {
        // Configurar la imagen de fondo del hero con JavaScript
        const heroSection = document.querySelector('.hero-section');
        if (heroSection) {
            const bgImage = heroSection.getAttribute('data-bg-image');
            if (bgImage) {
                heroSection.style.backgroundImage = `url('${bgImage}')`;
            }
            
            // Asegurarnos de que el hero tenga la clase fade-item
            if (!heroSection.classList.contains('fade-item')) {
                heroSection.classList.add('fade-item');
            }
        }
        
        // Obtener todas las secciones
        const sections = document.querySelectorAll('section');
        
        // Aplicar fade a todas las secciones excepto la primera
        for (let i = 1; i < sections.length; i++) {
            sections[i].classList.add('fade-item', `delay-${Math.min(i, 5)}`);
        }
        
        // Aplicar a títulos que no están en la primera sección
        const titles = document.querySelectorAll('h1, h2, h3');
        titles.forEach(title => {
            const isInFirstSection = title.closest('section') && 
                                    title.closest('section') === document.querySelector('section');
            
            if (!isInFirstSection) {
                title.classList.add('fade-item', 'delay-1');
            }
        });
        
        // Aplicar a tarjetas de servicios
        const serviceCards = document.querySelectorAll('.service-card');
        serviceCards.forEach((card, index) => {
            const isInFirstSection = card.closest('section') && 
                                    card.closest('section') === document.querySelector('section');
            
            if (!isInFirstSection) {
                card.classList.add('fade-item', `delay-${Math.min(index + 1, 5)}`);
            }
            
            // Añadir evento de clic para mantener la clase 'active'
            card.addEventListener('click', function() {
                // Remover clase active de todas las tarjetas
                serviceCards.forEach(c => c.classList.remove('active'));
                // Agregar clase active a la tarjeta clickeada
                this.classList.add('active');
            });
        });
        
        // Aplicar a imágenes dentro de las tarjetas de servicio
        const serviceImages = document.querySelectorAll('.service-card img');
        serviceImages.forEach((img, index) => {
            const isInFirstSection = img.closest('section') && 
                                     img.closest('section') === document.querySelector('section');
            
            if (!isInFirstSection) {
                img.classList.add('fade-item', `delay-${Math.min(index, 4)}`);
            }
        });
        
        // Aplicar a botones
        const buttons = document.querySelectorAll('.btn');
        buttons.forEach(button => {
            // Asegurar que todos los botones tengan la clase fade-item
            if (!button.classList.contains('fade-item')) {
                button.classList.add('fade-item');
            }
            
            // Asignar un retraso consistente a todos los botones
            // Removemos la condición que solo aplica la animación a botones fuera de la primera sección
            if (button.closest('.hero-content')) {
                // Para botones en el hero, usar delay-1 para que sea consistente
                button.classList.add('delay-1');
            } else {
                button.classList.add('delay-2');
            }
            
            // Activar la animación inicial para los botones del hero
            if (button.closest('.hero-content')) {
                setTimeout(() => {
                    button.classList.add('fade-in-active');
                }, 300);
            }
        });
        
        // Aplicar a párrafos
        const paragraphs = document.querySelectorAll('p.text-lg, p.mt-4');
        paragraphs.forEach(p => {
            const isInFirstSection = p.closest('section') && 
                                    p.closest('section') === document.querySelector('section');
            
            if (!isInFirstSection) {
                p.classList.add('fade-item', 'delay-1');
            }
        });
        
        // Añadir efecto de movimiento suave a las formas geométricas
        setupShapeAnimations();
    }
    
    // Función para animar las formas geométricas
    function setupShapeAnimations() {
        const shapes = document.querySelectorAll('.shape-disruptor');
        
        // Si hay formas, configurar animación sutil
        if (shapes.length > 0) {
            // Movimiento sutil aleatorio para cada forma
            shapes.forEach((shape, index) => {
                // Parámetros de animación ligeramente diferentes para cada forma
                const duration = 15 + (index * 5); // Duración entre 15-25s
                const delay = index * 2; // Retraso para que no se muevan al mismo tiempo
                
                // Aplicar animación CSS
                shape.style.animation = `floatShape ${duration}s ease-in-out ${delay}s infinite alternate`;
            });
            
            // Agregar keyframes de animación si no existen
            if (!document.getElementById('shape-keyframes')) {
                const styleSheet = document.createElement('style');
                styleSheet.id = 'shape-keyframes';
                styleSheet.textContent = `
                    @keyframes floatShape {
                        0% {
                            transform: translate(0, 0) rotate(0deg);
                        }
                        33% {
                            transform: translate(3%, 3%) rotate(2deg);
                        }
                        66% {
                            transform: translate(-3%, 5%) rotate(-1deg);
                        }
                        100% {
                            transform: translate(3%, -3%) rotate(1deg);
                        }
                    }
                `;
                document.head.appendChild(styleSheet);
            }
        }
    }
    
    // Activar animaciones con detección de visibilidad mejorada
    function activateAnimations() {
        // Función más precisa para verificar si un elemento está en el viewport
        function isElementInViewport(el) {
            const rect = el.getBoundingClientRect();
            const windowHeight = window.innerHeight || document.documentElement.clientHeight;
            
            // Elemento está completamente en el viewport
            const isCompletelyVisible = (
                rect.top >= 0 &&
                rect.bottom <= windowHeight
            );
            
            // Elemento está parcialmente visible (al menos 30%)
            const visibleHeight = Math.min(rect.bottom, windowHeight) - Math.max(rect.top, 0);
            const isPartiallyVisible = visibleHeight > (rect.height * 0.3);
            
            return isCompletelyVisible || isPartiallyVisible;
        }
        
        // Obtener todos los elementos animables
        const fadeItems = document.querySelectorAll('.fade-item');
        
        // Función para activar/desactivar elementos según visibilidad
        function updateElementVisibility() {
            fadeItems.forEach(item => {
                if (isElementInViewport(item)) {
                    if (!item.classList.contains('fade-in-active')) {
                        item.classList.add('fade-in-active');
                    }
                } else {
                    // Opcional: desactivar elementos cuando salen del viewport
                    // Si prefieres que los elementos permanezcan visibles después
                    // de aparecer, puedes comentar estas líneas
                    /*
                    if (item.classList.contains('fade-in-active')) {
                        item.classList.remove('fade-in-active');
                    }
                    */
                }
            });
        }
        
        // Actualizar visibilidad inicial
        updateElementVisibility();
        
        // Actualizar al hacer scroll
        window.addEventListener('scroll', updateElementVisibility, { passive: true });
        
        // Actualizar también al cambiar tamaño de ventana
        window.addEventListener('resize', updateElementVisibility, { passive: true });
    }
    
    // Configurar interacciones táctiles para dispositivos móviles
    function setupTouchInteractions() {
        // Seleccionar todas las tarjetas de servicio
        const serviceCards = document.querySelectorAll('.service-card');
        
        // Verificar si es un dispositivo táctil
        const isTouchDevice = 'ontouchstart' in window || navigator.maxTouchPoints > 0;
        
        if (isTouchDevice) {
            // Para dispositivos táctiles, agregar eventos touch
            serviceCards.forEach(card => {
                // Activar al tocar
                card.addEventListener('touchstart', function(e) {
                    // Evitar comportamientos predeterminados (opcional)
                    // e.preventDefault();
                    
                    // Primero removemos la clase active de todas las tarjetas
                    serviceCards.forEach(c => c.classList.remove('active'));
                    
                    // Luego la agregamos solo a la tarjeta tocada
                    this.classList.add('active');
                });
                
                // Opcional: desactivar después de un tiempo
                card.addEventListener('touchend', function() {
                    // Mantener el efecto por 2 segundos y luego quitarlo
                    setTimeout(() => {
                        this.classList.remove('active');
                    }, 2000);
                });
            });
            
            // Opcional: cerrar al tocar fuera de las tarjetas
            document.addEventListener('touchstart', function(e) {
                if (!e.target.closest('.service-card')) {
                    serviceCards.forEach(card => {
                        card.classList.remove('active');
                    });
                }
            });
        }
        
        // Opcionalmente: detectar cambios de orientación para ajustar las animaciones
        window.addEventListener('orientationchange', function() {
            // Reajustar animaciones según la orientación
            setTimeout(() => {
                serviceCards.forEach(card => {
                    card.classList.remove('active');
                });
            }, 100);
        });
    }
    
    // Efecto de cursor de luz
    function setupCursorEffect() {
        // Solo aplicar en dispositivos de escritorio
        if (window.innerWidth < 1024) return;
        
        const cursor = document.createElement('div');
        cursor.className = 'cursor-light';
        document.body.appendChild(cursor);
        
        // Estilo para el cursor
        cursor.style.position = 'fixed';
        cursor.style.width = '250px';
        cursor.style.height = '250px';
        cursor.style.borderRadius = '50%';
        cursor.style.background = 'radial-gradient(circle, rgba(201, 252, 254, 0.15) 0%, rgba(201, 252, 254, 0) 70%)';
        cursor.style.pointerEvents = 'none';
        cursor.style.zIndex = '9999';
        cursor.style.transform = 'translate(-50%, -50%)';
        cursor.style.opacity = '0';
        cursor.style.transition = 'opacity 0.3s ease';
        
        // Actualizar posición del cursor
        document.addEventListener('mousemove', function(e) {
            cursor.style.left = e.clientX + 'px';
            cursor.style.top = e.clientY + 'px';
            cursor.style.opacity = '1';
            
            // Ocultar después de 2 segundos sin movimiento
            clearTimeout(window.cursorTimeout);
            window.cursorTimeout = setTimeout(() => {
                cursor.style.opacity = '0';
            }, 2000);
        });
        
        // Efectos especiales al pasar sobre tarjetas
        const serviceCards = document.querySelectorAll('.service-card');
        serviceCards.forEach(card => {
            card.addEventListener('mouseover', function() {
                cursor.style.background = 'radial-gradient(circle, rgba(201, 252, 254, 0.25) 0%, rgba(201, 252, 254, 0) 70%)';
                cursor.style.width = '350px';
                cursor.style.height = '350px';
            });
            
            card.addEventListener('mouseout', function() {
                cursor.style.background = 'radial-gradient(circle, rgba(201, 252, 254, 0.15) 0%, rgba(201, 252, 254, 0) 70%)';
                cursor.style.width = '250px';
                cursor.style.height = '250px';
            });
        });
    }
    
    // Efecto de partículas en el fondo
    function setupParticlesEffect() {
        // Solo aplicar en dispositivos de escritorio para no afectar rendimiento
        if (window.innerWidth < 1024) return;
        
        // Crear contenedor de partículas
        const particlesContainer = document.createElement('div');
        particlesContainer.className = 'particles-container';
        particlesContainer.style.position = 'fixed';
        particlesContainer.style.top = '0';
        particlesContainer.style.left = '0';
        particlesContainer.style.width = '100%';
        particlesContainer.style.height = '100%';
        particlesContainer.style.pointerEvents = 'none';
        particlesContainer.style.zIndex = '0';
        document.body.appendChild(particlesContainer);
        
        // Crear partículas
        const particleCount = 30;
        
        for (let i = 0; i < particleCount; i++) {
            createParticle(particlesContainer);
        }
        
        function createParticle(container) {
            const particle = document.createElement('div');
            particle.className = 'particle';
            
            // Estilo base de partícula
            particle.style.position = 'absolute';
            particle.style.width = Math.random() * 3 + 1 + 'px';
            particle.style.height = particle.style.width;
            particle.style.background = 'rgba(201, 252, 254, ' + (Math.random() * 0.3 + 0.1) + ')';
            particle.style.borderRadius = '50%';
            
            // Posición inicial aleatoria
            particle.style.left = Math.random() * 100 + 'vw';
            particle.style.top = Math.random() * 100 + 'vh';
            
            // Añadir a contenedor
            container.appendChild(particle);
            
            // Animación de la partícula
            animateParticle(particle);
        }
        
        function animateParticle(particle) {
            // Duración aleatoria entre 15-30 segundos
            const duration = 15 + Math.random() * 15;
            
            // Destino aleatorio
            const destX = Math.random() * 100 + 'vw';
            const destY = Math.random() * 100 + 'vh';
            
            // Configurar animación
            particle.style.transition = `all ${duration}s ease-in-out`;
            
            // Iniciar movimiento después de un pequeño retraso
            setTimeout(() => {
                particle.style.left = destX;
                particle.style.top = destY;
                
                // Cuando termina esta animación, crear una nueva
                setTimeout(() => {
                    animateParticle(particle);
                }, duration * 1000);
            }, 100);
        }
    }
    
    // Ejecutar toda la configuración
    setupAnimations();
    setTimeout(activateAnimations, 100);
    setupTouchInteractions();
    setupCursorEffect();
    setupParticlesEffect();
    
    // Fix mejorado para el menú móvil
    const menuToggle = document.getElementById("menu-toggle");
    const mobileMenu = document.getElementById("mobile-menu");
    
    if (menuToggle && mobileMenu) {
        // Asegúrate de que el menú esté cerrado al inicio
        mobileMenu.classList.remove("open");
        
        menuToggle.addEventListener("click", function(e) {
            e.preventDefault(); // Prevenir comportamiento predeterminado
            e.stopPropagation(); // Evitar propagación del evento
            mobileMenu.classList.toggle("open");
        });
        
        // Cerrar menú al hacer clic en cualquier enlace del menú móvil
        const mobileLinks = mobileMenu.querySelectorAll('a');
        mobileLinks.forEach(link => {
            link.addEventListener('click', function() {
                mobileMenu.classList.remove("open");
            });
        });
        
        // Cerrar menú al hacer clic fuera
        document.addEventListener('click', function(e) {
            if (!mobileMenu.contains(e.target) && e.target !== menuToggle) {
                mobileMenu.classList.remove("open");
            }
        });
    }
    
    // Cambiar la apariencia del navbar al hacer scroll
    const navbar = document.querySelector(".navbar");
    if (navbar) {
        window.addEventListener("scroll", function() {
            if (window.scrollY > 10) { // Umbral reducido para que se active antes
                navbar.classList.add("scrolled");
            } else {
                navbar.classList.remove("scrolled");
            }
        });
        
        // Verificar scroll al cargar
        if (window.scrollY > 10) {
            navbar.classList.add("scrolled");
        }
    }
});