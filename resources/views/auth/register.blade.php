<x-auth-layout>
    <div class="auth-card-header">
        <h2 class="text-2xl font-semibold text-center mb-4 text-turquoise">Crear Cuenta</h2>
        <div class="auth-card-divider"></div>
    </div>
    
    <form method="POST" action="{{ route('register') }}">
        @csrf
        
        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="input-label">Nombre</label>
            <input
                id="name"
                type="text"
                name="name"
                value="{{ old('name') }}"
                required
                autofocus
                class="input-field"
                placeholder="Ingresa tu nombre"
            />
        </div>

        <!-- Email -->
        <div class="mb-4">
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

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="input-label">Contraseña</label>
            <input
                id="password"
                type="password"
                name="password"
                required
                class="input-field"
                placeholder="••••••••"
            />
        </div>

        <!-- Confirm Password -->
        <div class="mb-5">
            <label for="password_confirmation" class="input-label">Confirmar Contraseña</label>
            <input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
                required
                class="input-field"
                placeholder="••••••••"
            />
        </div>
        
        <!-- Botón de Envío -->
        <div class="flex justify-center">
            <button type="submit" class="admin-btn admin-btn-primary w-full">
                <span>Registrarse</span>
                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 ml-1" viewBox="0 0 20 20" fill="currentColor">
                    <path fill-rule="evenodd" d="M10.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L12.586 11H5a1 1 0 110-2h7.586l-2.293-2.293a1 1 0 010-1.414z" clip-rule="evenodd" />
                </svg>
            </button>
        </div>
        
        <div class="mt-4 text-center">
            <span class="text-gray-400">¿Ya tienes cuenta?</span>
            <a href="{{ route('login') }}" class="text-turquoise hover:text-light-blue ml-1 transition-colors">
                Inicia sesión
            </a>
        </div>
    </form>
</x-auth-layout>