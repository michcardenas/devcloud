<x-auth-layout>
    <h2 class="text-2xl font-semibold text-center mb-4">Crear Cuenta</h2>
    
    <form method="POST" action="{{ route('register') }}">
        @csrf
        
        <!-- Name -->
        <div class="mb-4">
            <label for="name" class="block mb-1">Nombre</label>
            <input
                id="name"
                type="text"
                name="name"
                value="{{ old('name') }}"
                required
                autofocus
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

        <!-- Email -->
        <div class="mb-4">
            <label for="email" class="block mb-1">Email</label>
            <input
                id="email"
                type="email"
                name="email"
                value="{{ old('email') }}"
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

        <!-- Password -->
        <div class="mb-4">
            <label for="password" class="block mb-1">Contraseña</label>
            <input
                id="password"
                type="password"
                name="password"
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

        <!-- Confirm Password -->
        <div class="mb-4">
            <label for="password_confirmation" class="block mb-1">Confirmar Contraseña</label>
            <input
                id="password_confirmation"
                type="password"
                name="password_confirmation"
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
        
        <!-- Botón de Envío -->
        <div class="flex justify-center">
            <button type="submit" class="auth-btn">
                Registrarse
            </button>
        </div>
    </form>
</x-auth-layout>
