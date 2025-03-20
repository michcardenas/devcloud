<x-auth-layout>
    <div class="auth-card-header">
        <h2 class="text-2xl font-semibold text-center mb-4 text-turquoise">Verifica tu Email</h2>
        <div class="auth-card-divider"></div>
    </div>
    
    <p class="mb-6 text-center text-gray-300">
        Gracias por registrarte. Antes de comenzar, por favor verifica tu dirección de correo electrónico con el enlace que te enviamos.
        Si no recibiste el correo, con gusto te enviaremos otro.
    </p>
    
    @if (session('status') == 'verification-link-sent')
        <div class="mb-6 p-3 bg-green-900 border-l-4 border-green-500 text-white rounded-md">
            Se ha enviado un nuevo enlace de verificación a tu correo electrónico.
        </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}" class="mb-4">
        @csrf
        <div class="flex justify-center">
            <button type="submit" class="admin-btn admin-btn-primary w-full">
                <span>Reenviar Enlace de Verificación</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                </svg>
            </button>
        </div>
    </form>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <div class="flex justify-center">
            <button type="submit" class="admin-btn admin-btn-outline w-full text-accent-orange border-accent-orange">
                <span>Cerrar Sesión</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M3 3a1 1 0 00-1 1v12a1 1 0 001 1h12a1 1 0 001-1V7.414l-5-5H3zm7 5a1 1 0 10-2 0v4.586l-1.293-1.293a1 1 0 10-1.414 1.414l3 3a1 1 0 001.414 0l3-3a1 1 0 00-1.414-1.414L12 12.586V8z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
    </form>
</x-auth-layout>