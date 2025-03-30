<div 
    x-data="cookieConsent()" 
    x-init="init()" 
    x-show="visible" 
    x-transition 
    class="fixed bottom-0 inset-x-0 z-50 bg-white border-t border-gray-200 shadow-lg p-4 md:p-6"
>
    <div class="container mx-auto">
        <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4">
            <div class="flex items-start gap-3">
                <div class="bg-cyan-100 text-cyan-600 p-2 rounded-full">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path d="M12 2a10 10 0 0 0 0 20 10 10 0 0 1 0-20zm1 14h-2v2h2v-2zm0-8h-2v6h2V8z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900">Uso de cookies</h3>
                    <p class="text-gray-600 max-w-3xl text-sm">
                        Utilizamos cookies propias y de terceros para mejorar nuestros servicios y mostrarle publicidad relacionada con sus preferencias.
                        Al continuar navegando consideramos que acepta su uso. Puede obtener más información en nuestra 
                        <a href="{{ url('/privacidad') }}" class="text-cyan-600 hover:underline">política de privacidad</a>.
                    </p>
                </div>
            </div>
            <div class="flex gap-2 w-full md:w-auto">
                <button 
                    @click="reject()" 
                    class="border border-gray-300 text-gray-700 rounded-md px-4 py-2 text-sm hover:bg-gray-100 w-full md:w-auto"
                >
                    Rechazar
                </button>
                <button 
                    @click="accept()" 
                    class="bg-cyan-600 text-white rounded-md px-4 py-2 text-sm hover:bg-cyan-700 w-full md:w-auto"
                >
                    Aceptar
                </button>
            </div>
        </div>
    </div>
</div>
