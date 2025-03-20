<x-auth-layout>
    <div class="auth-card-header">
        <h2 class="text-2xl font-semibold text-center mb-4 text-turquoise">Confirmar Contraseña</h2>
        <div class="auth-card-divider"></div>
    </div>
    
    <p class="mb-6 text-center text-gray-300">
        Esta es un área segura de la aplicación. Por favor, confirma tu contraseña antes de continuar.
    </p>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf
        
        <!-- Password -->
        <div class="mb-5">
            <label for="password" class="input-label">Contraseña</label>
            <input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                class="input-field"
                placeholder="••••••••"
            />
        </div>

        <div class="flex justify-center">
            <button type="submit" class="admin-btn admin-btn-primary w-full">
                <span>Confirmar</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
        
        <div class="mt-4 text-center">
            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}" class="text-turquoise hover:text-light-blue transition-colors">
                    ¿Olvidaste tu contraseña?
                </a>
            @endif
        </div>
    </form>
</x-auth-layout>