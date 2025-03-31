<!-- Cookie Consent Component -->
<script>
function cookieConsent() {
    return {
        visible: false,
        preferences: {
            essential: true, // Siempre activas
            analytics: false,
            marketing: false,
        },

        init() {
            console.log('[CookieBanner] Init...');
            const saved = localStorage.getItem('cookie-preferences');
            if (saved) {
                this.preferences = JSON.parse(saved);
                this.loadScripts();
            } else {
                setTimeout(() => this.visible = true, 1000);
            }
        },

        setCookie(name, value, days = 365) {
            const expires = new Date(Date.now() + days * 864e5).toUTCString();
            document.cookie = `${name}=${value}; expires=${expires}; path=/`;
        },

        savePreferences() {
            console.log('[CookieBanner] Preferences saved:', this.preferences);
            localStorage.setItem('cookie-preferences', JSON.stringify(this.preferences));
            this.setCookie('cookie-preferences', JSON.stringify(this.preferences));
            this.visible = false;
            this.loadScripts();
        },

        loadScripts() {
            if (this.preferences.analytics) {
                console.log('[CookieBanner] Cargando Analytics...');
                const script = document.createElement('script');
                script.src = 'https://www.googletagmanager.com/gtag/js?id=GA_ID';
                script.async = true;
                document.head.appendChild(script);

                window.dataLayer = window.dataLayer || [];
                function gtag(){dataLayer.push(arguments);}
                gtag('js', new Date());
                gtag('config', 'GA_ID');
            }

            if (this.preferences.marketing) {
                console.log('[CookieBanner] Cargando Marketing...');
                // Aquí podrías cargar Facebook Pixel, etc.
            }
        }
    }
}
</script>

<div 
    x-data="cookieConsent()" 
    x-init="init()" 
    x-show="visible"
    x-transition
    class="fixed bottom-0 inset-x-0 z-50 bg-white border-t border-gray-200 shadow-lg p-6"
    role="dialog"
    aria-modal="true"
    aria-labelledby="cookieConsentTitle"
>
    <div class="container mx-auto">
        <div class="flex flex-col gap-4">
            <!-- Título y descripción -->
            <div class="flex items-start gap-3">
                <div class="bg-cyan-100 text-cyan-600 p-2 rounded-full">
                    <svg class="h-5 w-5" fill="none" stroke="currentColor" stroke-width="2" viewBox="0 0 24 24">
                        <path d="M12 2a10 10 0 0 0 0 20 10 10 0 0 1 0-20zm1 14h-2v2h2v-2zm0-8h-2v6h2V8z"/>
                    </svg>
                </div>
                <div>
                    <h3 class="text-lg font-semibold text-gray-900" id="cookieConsentTitle">Tu privacidad importa</h3>
                    <p class="text-gray-600 text-sm">
                        Utilizamos cookies para mejorar tu experiencia. Puedes personalizar tu configuración. Consulta nuestra
                        <a href="{{ url('/politica-cookies') }}" class="text-cyan-600 hover:underline">política de cookies</a>.
                    </p>
                </div>
            </div>

            <!-- Opciones de cookies -->
            <div class="flex flex-col gap-2 text-sm text-gray-700">
                <label class="flex items-center gap-2">
                    <input type="checkbox" checked disabled class="accent-cyan-600">
                    Cookies esenciales (obligatorias)
                </label>
                <label class="flex items-center gap-2">
                    <input type="checkbox" x-model="preferences.analytics" class="accent-cyan-600">
                    Cookies de análisis (Google Analytics, etc.)
                </label>
                <label class="flex items-center gap-2">
                    <input type="checkbox" x-model="preferences.marketing" class="accent-cyan-600">
                    Cookies de marketing (Facebook Pixel, etc.)
                </label>
            </div>

            <!-- Botones -->
            <div class="flex flex-col md:flex-row justify-end gap-2 pt-4">
                <button 
                    @click="preferences.analytics = false; preferences.marketing = false; savePreferences()" 
                    class="border border-gray-300 text-gray-700 rounded-md px-4 py-2 hover:bg-gray-100"
                >
                    Solo esenciales
                </button>
                <button 
                    @click="savePreferences()" 
                    class="bg-cyan-600 text-white rounded-md px-4 py-2 hover:bg-cyan-700"
                >
                    Guardar preferencias
                </button>
            </div>
        </div>
    </div>
</div>
