@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto py-10 px-4">
    {{-- Encabezado y botón --}}
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Colaboradores</h2>
        <button onclick="abrirModalCrear()" 
            class="inline-block bg-cyan-600 hover:bg-cyan-700 text-white font-semibold px-5 py-2 rounded-lg transition">
            + Crear Colaborador
        </button>

    </div>

    {{-- Tabla --}}
    <div class="overflow-x-auto rounded-lg shadow-lg">
        <table class="min-w-full bg-white border border-gray-200 text-sm text-gray-700">
            <thead class="bg-cyan-600 text-white uppercase text-xs tracking-wider">
                <tr>
                    <th class="px-6 py-3 text-left">Nombre</th>
                    <th class="px-6 py-3 text-left">Cargo</th>
                    <th class="px-6 py-3 text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($colaboradores as $colaborador)
                    <tr class="border-b hover:bg-gray-50">
                        <td class="px-6 py-4">{{ $colaborador->nombre }}</td>
                        <td class="px-6 py-4">{{ $colaborador->cargo }}</td>
                        <td class="px-6 py-4 text-center space-x-2">
                            <button 
                            onclick="abrirModalEditar(
                                {{ $colaborador->id }},
                                '{{ $colaborador->nombre }}',
                                '{{ $colaborador->cargo }}',
                                '{{ $colaborador->departamento }}',
                                '{{ $colaborador->linkedin }}',
                                `{{ $colaborador->descripcion ?? '' }}`,
                                `{{ basename($colaborador->imagen) }}`
                            )"

                                class="inline-block bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded text-xs">
                                Editar
                            </button>

                            <form action="{{ route('admin.colaboradores.destroy', $colaborador->id) }}" method="POST" class="inline-block" onsubmit="return confirm('¿Eliminar este colaborador?')">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded text-xs">
                                    Eliminar
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3" class="text-center py-6 text-gray-400">
                            No hay colaboradores registrados.
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>

{{-- Modal --}}
<div id="modalColaborador" 
     class="fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50 hidden">
  <div class="bg-white rounded-lg shadow-xl w-full max-w-lg p-6 relative z-50 max-h-[90vh] overflow-y-auto">


        {{-- Botón cerrar --}}
        <button onclick="document.getElementById('modalColaborador').classList.add('hidden')" 
                class="absolute top-3 right-4 text-gray-500 hover:text-red-500 text-xl font-bold">&times;</button>

        {{-- Título dinámico --}}
        <h3 id="modalTitulo" class="text-xl font-bold mb-4 text-gray-800">Agregar Colaborador</h3>

        <form id="formColaborador" method="POST" enctype="multipart/form-data">
        @csrf
        <input type="hidden" name="_method" value="POST" id="metodoForm">


            <div class="mb-4">
                <label for="nombre" class="block text-sm font-medium text-gray-700">Nombre</label>
                <input type="text" name="nombre" id="inputNombre" class="text-gray-800 mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2">
            </div>
            <div class="mb-4">
                <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción</label>
                <textarea name="descripcion" id="inputDescripcion" class="text-gray-800 mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2" rows="3"></textarea>
            </div>


            <div class="mb-4">
                <label for="cargo" class="block text-sm font-medium text-gray-700">Cargo</label>
                <input type="text" name="cargo" id="inputCargo" class="text-gray-800 mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2">
            </div>

            <div class="mb-4">
                <label for="departamento" class="block text-sm font-medium text-gray-700">Departamento</label>
                <input type="text" name="departamento" id="inputDepartamento" class="text-gray-800 mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2">
            </div>

            <div class="mb-4">
                <label for="linkedin" class="block text-sm font-medium text-gray-700">LinkedIn</label>
                <input type="text" name="linkedin" id="inputLinkedin" class="text-gray-800 mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2">
            </div>
            <div class="mb-4">
                <label for="imagen" class="block text-sm font-medium text-gray-700">Foto de perfil</label>
                <input type="file" name="imagen" id="inputImagen"
                    class="text-gray-800 mt-1 block w-full border border-gray-300 rounded-md shadow-sm px-3 py-2">
            </div>
            <div id="imagenPreviewContainer" class="mb-4 hidden">
                <label class="block text-sm font-medium text-gray-700">Imagen actual</label>
                <img id="imagenPreview" src="" alt="Imagen actual" class="mt-2 rounded-md shadow-md w-32 h-32 object-cover">
            </div>



            <div class="text-end">
                <button type="submit" class="bg-cyan-600 hover:bg-cyan-700 text-white font-semibold px-4 py-2 rounded-lg">
                    Guardar
                </button>
            </div>
        </form>
    </div>
</div>

{{-- Scripts --}}
<script>
function abrirModalCrear() {
    document.getElementById('modalTitulo').textContent = 'Agregar Colaborador';
    document.getElementById('formColaborador').reset();
    document.getElementById('metodoForm').value = 'POST';
    document.getElementById('formColaborador').action = `{{ route('admin.colaboradores.store') }}`;

    // Ocultar preview de imagen si había alguna
    const previewContainer = document.getElementById('imagenPreviewContainer');
    if (previewContainer) {
        previewContainer.classList.add('hidden');
        document.getElementById('imagenPreview').src = '';
    }

    document.getElementById('modalColaborador').classList.remove('hidden');
}

function abrirModalEditar(id, nombre, cargo, departamento, linkedin, descripcion = '', imagen = null) {
    document.getElementById('modalTitulo').textContent = 'Editar Colaborador';
    document.getElementById('metodoForm').value = 'PUT';
    document.getElementById('formColaborador').action = `/admin/colaboradores/${id}`;

    document.getElementById('inputNombre').value = nombre;
    document.getElementById('inputDescripcion').value = descripcion;
    document.getElementById('inputCargo').value = cargo;
    document.getElementById('inputDepartamento').value = departamento;
    document.getElementById('inputLinkedin').value = linkedin;


    const preview = document.getElementById('imagenPreview');
    const previewContainer = document.getElementById('imagenPreviewContainer');

    if (imagen) {
        preview.src = `/images/colaboradores/${imagen}`;
        preview.alt = 'Imagen del colaborador';
        previewContainer.classList.remove('hidden');
    } else {
        preview.src = '';
        previewContainer.classList.add('hidden');
    }

    document.getElementById('modalColaborador').classList.remove('hidden');
}







</script>


@endsection
