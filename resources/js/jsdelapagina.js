
document.addEventListener('DOMContentLoaded', function() {
    // Control del menú móvil
    const menuToggle = document.getElementById("menu-toggle");
    const mobileMenu = document.getElementById("mobile-menu");
    
    if (menuToggle && mobileMenu) {
        menuToggle.addEventListener("click", function() {
            mobileMenu.classList.toggle("open");
        });
    }

    // Cambiar estilo de navbar al hacer scroll
    const navbar = document.querySelector(".navbar");
    
    if (navbar) {
        window.addEventListener("scroll", function() {
            if (window.scrollY > 50) {
                navbar.classList.add("scrolled");
            } else {
                navbar.classList.remove("scrolled");
            }
        });
    }
});