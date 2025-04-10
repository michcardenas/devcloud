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
                
                // Opcional: Añadir una clase para cambiar el aspecto del botón hamburguesa
                menuToggle.classList.toggle("active");
            });
            
            // Cerrar menú al hacer clic en cualquier enlace del menú móvil
            const mobileLinks = mobileMenu.querySelectorAll('a');
            mobileLinks.forEach(link => {
                link.addEventListener('click', function() {
                    mobileMenu.classList.remove("open");
                    menuToggle.classList.remove("active");
                });
            });
            
            // Cerrar menú al hacer clic fuera
            document.addEventListener('click', function(e) {
                if (!mobileMenu.contains(e.target) && e.target !== menuToggle && !menuToggle.contains(e.target)) {
                    mobileMenu.classList.remove("open");
                    menuToggle.classList.remove("active");
                }
            });
        }
    }
    
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
    
    // Eliminar el evento duplicado que se está añadiendo fuera del DOMContentLoaded
    // Para mantener el efecto, lo integramos en setupNavbarScroll

    const filterButtons = document.querySelectorAll('.filter-btn');
    const partnerItems = document.querySelectorAll('.partner-item');
    
    // Verificar si hay elementos
    console.log("Total de partners en la página: " + partnerItems.length);
    
    filterButtons.forEach(button => {
        button.addEventListener('click', function() {
            // Actualizar estado activo de los botones
            filterButtons.forEach(btn => btn.classList.remove('active', 'bg-cyan-500', 'text-white'));
            filterButtons.forEach(btn => btn.classList.add('bg-white', 'text-gray-700'));
            this.classList.remove('bg-white', 'text-gray-700');
            this.classList.add('active', 'bg-cyan-500', 'text-white');
            
            const filterValue = this.getAttribute('data-filter');
            console.log("Aplicando filtro: " + filterValue);
            
            // Mostrar u ocultar elementos según el filtro
            partnerItems.forEach((item, index) => {
                if (filterValue === 'todos' || item.classList.contains(filterValue)) {
                    item.style.display = 'block';
                } else {
                    item.style.display = 'none';
                }
            });
        });
    });


    const toggleFormBtn = document.getElementById('toggleFormBtn');
    const partnershipForm = document.getElementById('partnershipForm');
    
  if(toggleFormBtn && partnershipForm) { 
    toggleFormBtn.addEventListener('click', function() {
        const isHidden = partnershipForm.style.display === 'none';
        
        partnershipForm.style.display = isHidden ? 'block' : 'none';
        toggleFormBtn.querySelector('span').textContent = isHidden ? 'Ocultar formulario' : 'Mostrar formulario';
    });
}


});




window.addEventListener('DOMContentLoaded', () => {
  const navbar = document.querySelector('.navbar');
  const hero = document.querySelector('.hero-container');

  if (navbar && hero) {
    const navbarHeight = navbar.offsetHeight;
    hero.style.marginTop = `${navbarHeight}px`;
  }
});







function scrollToContacto(servicio = '') {
    const contacto = document.getElementById('contacto');
    const selectServicio = document.getElementById('servicio');

    if (contacto) {
        contacto.scrollIntoView({ behavior: 'smooth' });
    }

    if (selectServicio && servicio) {
        // Esperamos un poquito para asegurar que el scroll terminó
        setTimeout(() => {
            Array.from(selectServicio.options).forEach(option => {
                if (option.text.trim().toLowerCase() === servicio.trim().toLowerCase()) {
                    option.selected = true;
                }
            });
        }, 500);
    }

}
const swiper = new Swiper(".mySwiper", {
    slidesPerView: 1,
    spaceBetween: 0,
    loop: true,
    centeredSlides: false,
    pagination: {
        el: ".swiper-pagination",
        clickable: true,
    },
    autoplay: {
        delay: 6000,
        disableOnInteraction: false,
    },
});
