<div 
    x-data="{ isVisible: false }"
    x-init="window.addEventListener('scroll', () => { isVisible = window.scrollY > 300 })"
    x-show="isVisible"
    x-transition.opacity
    class="fixed bottom-6 right-6 z-50"
>
    <button 
        @click="window.scrollTo({ top: 0, behavior: 'smooth' })"
        class="p-3 rounded-full bg-cyan-600 text-white shadow-lg hover:bg-cyan-700 transition"
        aria-label="Volver arriba"
    >
        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 10l7-7m0 0l7 7m-7-7v18" />
        </svg>
    </button>
</div>
