<x-auth-layout>
    <h2 class="text-2xl font-semibold text-center mb-4">Iniciar Sesión</h2>
    
    <form method="POST" action="{{ route('login') }}">
        @csrf
        
        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block mb-1">Email</label>
            <input
                id="email"
                type="email"
                name="email"
                required
                autofocus
                class="
                    appearance-none
                    w-full
                    px-3
                    py-2
                    bg-transparent
                    text-[#c9fcfe]
                    border
                    border-[#1f1f1f]
                    rounded
                    focus:outline-none
                    focus:ring-2
                    focus:ring-[#d5f9ff]
                "
            />
        </div>

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block mb-1">Contraseña</label>
            <input
                id="password"
                type="password"
                name="password"
                required
                class="
                    appearance-none
                    w-full
                    px-3
                    py-2
                    bg-transparent
                    text-[#c9fcfe]
                    border
                    border-[#1f1f1f]
                    rounded
                    focus:outline-none
                    focus:ring-2
                    focus:ring-[#d5f9ff]
                "
            />
        </div>

        <!-- Recordarme + ¿Olvidaste tu contraseña? -->
        <div class="flex items-center justify-between mb-4">
            <label for="remember_me" class="flex items-center">
                <input
                    id="remember_me"
                    type="checkbox"
                    class="
                        appearance-none
                        h-4
                        w-4
                        bg-transparent
                        border
                        border-[#1f1f1f]
                        rounded
                        focus:outline-none
                        focus:ring-2
                        focus:ring-[#d5f9ff]
                    "
                    name="remember"
                >
                <span class="ml-2 text-sm text-[#c9fcfe]">Recordarme</span>
            </label>

            @if (Route::has('password.request'))
                <a
                    class="underline text-sm text-[#c9fcfe] hover:text-[#d5f9ff]"
                    href="{{ route('password.request') }}"
                >
                    ¿Olvidaste tu contraseña?
                </a>
            @endif
        </div>
        
        <!-- Botón de Envío -->
        <div class="flex justify-center">
            <button
                type="submit"
                class="auth-btn"
            >
                Ingresar
            </button>
        </div>
    </form>
</x-auth-layout>