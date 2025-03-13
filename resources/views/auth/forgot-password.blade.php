<x-auth-layout>
    <h2 class="text-2xl font-semibold text-center mb-4">¿Olvidaste tu contraseña?</h2>
    <p class="mb-4 text-center">
        Ingresa tu email y te enviaremos un enlace para restablecer tu contraseña.
    </p>

    <form method="POST" action="{{ route('password.email') }}">
        @csrf
        
        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block mb-1">Email</label>
            <input
                id="email"
                type="email"
                name="email"
                required
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
                Enviar enlace de restablecimiento
            </button>
        </div>
    </form>
</x-auth-layout>
