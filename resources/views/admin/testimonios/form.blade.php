@extends('layouts.admin')

@section('title', isset($testimonio) ? 'Editar Testimonio' : 'Agregar Testimonio')

@section('content')
<!-- Encabezado -->
<div class="py-6 bg-gradient-to-r from-gray-900 to-black border-b border-gray-800">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <h2 class="font-semibold text-xl text-[#c9fcfe] leading-tight">
            {{ isset($testimonio) ? 'Editar Testimonio' : 'Agregar Testimonio' }}
        </h2>
    </div>
</div>

<!-- Formulario -->
<div class="max-w-7xl mx-auto sm:px-6 lg:px-8 my-6">
    <div class="bg-[#0a0a0a] border border-gray-800 rounded-lg overflow-hidden shadow-lg p-6">
        <form action="{{ isset($testimonio) ? route('admin.homepage.testimonios.update', $testimonio->id) : route('admin.homepage.testimonios.store') }}" method="POST">
            @csrf
            @if(isset($testimonio))
                @method('PUT')
            @endif

            <!-- Campo Nombre -->
            <div class="mb-4">
                <label for="nombre" class="block text-sm font-medium text-gray-400 mb-1">Nombre</label>
                <input type="text" id="nombre" name="nombre" class="w-full bg-gray-900 border border-gray-700 rounded-md py-2 px-3 text-[#c9fcfe] focus:outline-none focus:ring-2 focus:ring-blue-500" 
                       value="{{ old('nombre', $testimonio->nombre ?? '') }}">
            </div>

            <!-- Campo Cargo -->
            <div class="mb-4">
                <label for="cargo" class="block text-sm font-medium text-gray-400 mb-1">Cargo</label>
                <input type="text" id="cargo" name="cargo" class="w-full bg-gray-900 border border-gray-700 rounded-md py-2 px-3 text-[#c9fcfe] focus:outline-none focus:ring-2 focus:ring-blue-500" 
                       value="{{ old('cargo', $testimonio->cargo ?? '') }}">
            </div>

            <!-- Campo Contenido -->
            <div class="mb-4">
                <label for="contenido" class="block text-sm font-medium text-gray-400 mb-1">Contenido</label>
                <textarea id="contenido" name="contenido" rows="4" class="w-full bg-gray-900 border border-gray-700 rounded-md py-2 px-3 text-[#c9fcfe] focus:outline-none focus:ring-2 focus:ring-blue-500">{{ old('contenido', $testimonio->contenido ?? '') }}</textarea>
            </div>

            <!-- Campo Número de Estrellas -->
            <div class="mb-4">
                <label for="numero_de_estrellas" class="block text-sm font-medium text-gray-400 mb-1">Número de Estrellas</label>
                <input type="number" id="numero_de_estrellas" name="numero_de_estrellas" min="1" max="5" class="w-full bg-gray-900 border border-gray-700 rounded-md py-2 px-3 text-[#c9fcfe] focus:outline-none focus:ring-2 focus:ring-blue-500" 
                       value="{{ old('numero_de_estrellas', $testimonio->numero_de_estrellas ?? 5) }}">
            </div>

            <!-- Botones de acción -->
            <div class="flex justify-end">
                <a href="{{ route('admin.homepage.testimonios.index') }}" class="px-4 py-2 bg-gray-800 text-gray-300 rounded-md hover:bg-gray-700 transition mr-4">
                    Cancelar
                </a>
                <button type="submit" class="px-4 py-2 bg-blue-900 text-[#c9fcfe] rounded-md hover:bg-blue-800 transition">
                    {{ isset($testimonio) ? 'Actualizar' : 'Guardar' }}
                </button>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
@endpush
