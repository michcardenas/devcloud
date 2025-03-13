<x-auth-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-[#c9fcfe] leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-[#0a0a0a] border border-gray-800 overflow-hidden shadow-lg sm:rounded-lg">
                <div class="p-6 text-[#c9fcfe]">
                    {{ __("You're logged in!") }}
                </div>
            </div>
        </div>
    </div>
    
    <!-- Tarjetas de estadísticas -->
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 mb-8">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
            <div class="bg-[#0a0a0a] border border-gray-800 rounded-lg p-6 shadow">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-blue-900 bg-opacity-25">
                        <svg class="w-8 h-8 text-[#c9fcfe]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-400 text-sm">Usuarios</p>
                        <p class="text-2xl font-semibold text-[#c9fcfe]">2,789</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-[#0a0a0a] border border-gray-800 rounded-lg p-6 shadow">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-green-900 bg-opacity-25">
                        <svg class="w-8 h-8 text-[#c9fcfe]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-400 text-sm">Proyectos</p>
                        <p class="text-2xl font-semibold text-[#c9fcfe]">142</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-[#0a0a0a] border border-gray-800 rounded-lg p-6 shadow">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-purple-900 bg-opacity-25">
                        <svg class="w-8 h-8 text-[#c9fcfe]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-400 text-sm">Servicios</p>
                        <p class="text-2xl font-semibold text-[#c9fcfe]">24</p>
                    </div>
                </div>
            </div>
            
            <div class="bg-[#0a0a0a] border border-gray-800 rounded-lg p-6 shadow">
                <div class="flex items-center">
                    <div class="p-3 rounded-full bg-red-900 bg-opacity-25">
                        <svg class="w-8 h-8 text-[#c9fcfe]" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-400 text-sm">Ingresos</p>
                        <p class="text-2xl font-semibold text-[#c9fcfe]">$89,241</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-auth-layout>