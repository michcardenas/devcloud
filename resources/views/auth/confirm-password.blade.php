<x-auth-layout>
    <h2 class="text-2xl font-semibold text-center mb-4">Confirmar Contraseña</h2>
    <p class="mb-4 text-center">
        Esta es un área segura de la aplicación. Por favor, confirma tu contraseña antes de continuar.
    </p>

    <form method="POST" action="{{ route('password.confirm') }}">
        @csrf
        
        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block mb-1">Contraseña</label>
            <input
                id="password"
                type="password"
                name="password"
                required
                autocomplete="current-password"
                class="
                    w-full
                    px-3
                    py-2
                    bg-[#0a0a0a]
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

        <div class="flex justify-center">
            <button type="submit" class="auth-btn">
                Confirmar
            </button>
        </div>
    </form>
</x-auth-layout>
