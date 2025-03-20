<x-auth-layout>
    <div class="auth-card-header">
        <h2 class="text-2xl font-semibold text-center mb-4 text-turquoise">¿Olvidaste tu contraseña?</h2>
        <div class="auth-card-divider"></div>
    </div>
    
    <p class="mb-6 text-center text-gray-300">
        Ingresa tu email y te enviaremos un enlace para restablecer tu contraseña.
    </p>

    <!-- Session Status -->
    @if (session('status'))
        <div class="mb-4 p-3 bg-green-900 border-l-4 border-green-500 text-white rounded-md">
            {{ session('status') }}
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        
        <!-- Email -->
        <div class="mb-5">
            <label for="email" class="input-label">Email</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
                required
                class="input-field"
                placeholder="tu@email.com"
            />
        </div>

        <div class="flex justify-center">
            <button type="submit" class="admin-btn admin-btn-primary w-full">
                <span>Enviar enlace de restablecimiento</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                    <path d="M2.003 5.884L10 9.882l7.997-3.998A2 2 0 0016 4H4a2 2 0 00-1.997 1.884z" />
                    <path d="M18 8.118l-8 4-8-4V14a2 2 0 002 2h12a2 2 0 002-2V8.118z" />
                </svg>
            </button>
        </div>
        
        <div class="mt-4 text-center">
            <a href="{{ route('login') }}" class="text-turquoise hover:text-light-blue transition-colors">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4 inline mr-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M9.707 16.707a1 1 0 01-1.414 0l-6-6a1 1 0 010-1.414l6-6a1 1 0 011.414 1.414L5.414 9H17a1 1 0 110 2H5.414l4.293 4.293a1 1 0 010 1.414z" clip-rule="evenodd" />
                </svg>
                Volver a iniciar sesión
            </a>
        </div>
    </form>
</x-auth-layout>