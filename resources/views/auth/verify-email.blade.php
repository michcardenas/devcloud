<x-auth-layout>
    <h2 class="text-2xl font-semibold text-center mb-4">Verifica tu Email</h2>
    <p class="mb-4 text-center">
        Gracias por registrarte. Antes de comenzar, por favor verifica tu dirección de correo electrónico con el enlace que te enviamos.
        Si no recibiste el correo, con gusto te enviaremos otro.
    </p>
    
    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 text-sm text-green-400">
            Se ha enviado un nuevo enlace de verificación a tu correo electrónico.
        </div>
    @endif

    <form method="POST" action="{{ route('verification.send') }}">
        @csrf
        <div class="flex justify-center mb-2">
            <button type="submit" class="auth-btn">
                Reenviar Enlace de Verificación
            </button>
        </div>
    </form>

    <form method="POST" action="{{ route('logout') }}">
        @csrf
        <div class="flex justify-center">
            <button type="submit" class="auth-btn bg-red-700 hover:bg-red-800">
                Cerrar Sesión
            </button>
        </div>
    </form>
</x-auth-layout>
