@extends('layouts.admin')

@section('title', 'Testimonios - Administración')

@section('content')
<!-- Encabezado -->
<div class="py-6 bg-gradient-to-r from-gray-900 to-black border-b border-gray-800">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-[#c9fcfe] leading-tight">Administración de Testimonios</h2>
        <p class="mt-2 text-gray-400">Gestiona los testimonios de tus clientes</p>
    </div>
</div>

<!-- Mensajes de éxito y errores -->
@if(session('success'))
<div class="py-3 max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-green-900 bg-opacity-20 border border-green-800 text-green-300 px-4 py-3 rounded-lg">
        <span class="inline-block align-middle mr-2">
            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
            </svg>
        </span>
        {{ session('success') }}
    </div>
</div>
@endif

@if($errors->any())
<div class="py-3 max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-red-900 bg-opacity-20 border border-red-800 text-red-300 px-4 py-3 rounded-lg">
        <ul class="list-disc list-inside">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
</div>
@endif

<!-- Botón para agregar nuevo testimonio -->
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mb-6">
    <a href="{{ route('admin.homepage.testimonios.create') }}" class="px-4 py-2 bg-blue-900 text-[#c9fcfe] rounded-md hover:bg-blue-800 transition">
        Agregar Testimonio
    </a>
</div>

<!-- Listado de testimonios -->
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
    <div class="bg-[#0a0a0a] border border-gray-800 rounded-lg overflow-hidden shadow-lg">
        <div class="p-6">
            <table class="min-w-full divide-y divide-gray-700">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium text-[#c9fcfe]">Nombre</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-[#c9fcfe]">Cargo</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-[#c9fcfe]">Estrellas</th>
                        <th class="px-6 py-3 text-left text-sm font-medium text-[#c9fcfe]">Acciones</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-800">
                    @forelse($testimonios as $testimonio)
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap text-[#c9fcfe]">{{ $testimonio->nombre }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-[#c9fcfe]">{{ $testimonio->cargo }}</td>
                            <td class="px-6 py-4 whitespace-nowrap text-[#c9fcfe]">{{ $testimonio->numero_de_estrellas }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <a href="{{ route('admin.homepage.testimonios.edit', $testimonio->id) }}" class="text-blue-400 hover:text-blue-300 mr-4">Editar</a>
                                <form action="{{ route('admin.homepage.testimonios.destroy', $testimonio->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:text-red-400" onclick="return confirm('¿Estás seguro de eliminar este testimonio?')">
                                        Eliminar
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="4" class="px-6 py-4 text-center text-[#c9fcfe]">No hay testimonios registrados.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@push('scripts')
@endpush
