document.addEventListener('DOMContentLoaded', function() {
    // Configurar fondo del hero
    function setupHeroBackground() {
        const heroSection = document.querySelector('.hero-section');
        if (heroSection) {
            const bgImage = heroSection.getAttribute('data-bg-image');
            if (bgImage) {
                heroSection.style.backgroundImage = `url('${bgImage}')`;
            }
        }
    }
  
    document.getElementById('menu-toggle').addEventListener('click', function () {
        document.getElementById('mobile-menu').classList.toggle('open');
    });


    
    // Activar animaciones con detección de visibilidad
    function setupScrollAnimations() {
        // Función para verificar si un elemento está en el viewport
        function isElementInViewport(el) {
            const rect = el.getBoundingClientRect();
            const windowHeight = window.innerHeight || document.documentElement.clientHeight;
            
            // Elemento está parcialmente visible (al menos 30%)
            const visibleHeight = Math.min(rect.bottom, windowHeight) - Math.max(rect.top, 0);
            const isPartiallyVisible = visibleHeight > (rect.height * 0.3);
            
            return isPartiallyVisible;
        }
        
        // Obtener todos los elementos con la clase scroll-reveal
        const scrollItems = document.querySelectorAll('.scroll-reveal');
        
        // Función para activar elementos según visibilidad
        function updateElementVisibility() {
            scrollItems.forEach(item => {
                if (isElementInViewport(item)) {
                    if (!item.classList.contains('revealed')) {
                        item.classList.add('revealed');
                    }
                }
            });
        }
        
        // Actualizar visibilidad inicial
        updateElementVisibility();
        
        // Actualizar al hacer scroll con throttling para mejor rendimiento
        let scrollTimeout;
        window.addEventListener('scroll', function() {
            if (!scrollTimeout) {
                scrollTimeout = setTimeout(function() {
                    updateElementVisibility();
                    scrollTimeout = null;
                }, 10); // 10ms de throttling
            }
        }, { passive: true });
        
        // Actualizar también al cambiar tamaño de ventana
        window.addEventListener('resize', updateElementVisibility, { passive: true });
    }
    
    // Efecto de formas geométricas flotantes
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
    
    // Fix para el menú móvil
    function setupMobileMenu() {
        const menuToggle = document.getElementById("menu-toggle");
        const mobileMenu = document.getElementById("mobile-menu");
        
        if (menuToggle && mobileMenu) {
            // Asegúrate de que el menú esté cerrado al inicio
            mobileMenu.classList.remove("open");
            
            menuToggle.addEventListener("click", function(e) {
                e.preventDefault();
                e.stopPropagation();
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
    }
    
    // Cambiar la apariencia del navbar al hacer scroll
    function setupNavbarScroll() {
        const navbar = document.querySelector(".navbar");
        if (navbar) {
            window.addEventListener("scroll", function() {
                if (window.scrollY > 10) {
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
    }
    
    // Ejecutar las funciones necesarias
    setupHeroBackground();
    setupScrollAnimations();
    setupShapeAnimations();
    setupMobileMenu();
    setupNavbarScroll();
});
window.addEventListener('scroll', function () {
    const navbar = document.querySelector('.navbar');
    if (window.scrollY > 20) {
        navbar.classList.add('navbar-scrolled');
    } else {
        navbar.classList.remove('navbar-scrolled');
    }
});