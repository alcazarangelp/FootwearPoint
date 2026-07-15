@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg">
            <div class="p-6 border-b flex justify-between items-center">
                <h1 class="text-3xl font-bold text-gray-800">Gestión de Líneas</h1>
                <button onclick="openCreateModal()" 
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-lg font-medium flex items-center gap-2">
                    <span>+</span> Nueva Línea
                </button>
            </div>

            <!-- Mensaje de éxito -->
            @if (session('success'))
                <div class="m-6 bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
                    {{ session('success') }}
                </div>
            @endif

            <!-- Tabla -->
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Nombre</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Descuento</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Estado</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($lineas as $linea)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4">{{ $linea->nombre }}</td>
                            <td class="px-6 py-4">{{ $linea->descuento }}</td>
                            <td class="px-6 py-4">
                                <span class="px-3 py-1 text-xs font-medium rounded-full 
                                    {{ $linea->activa ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' }}">
                                    {{ $linea->activa ? 'Activa' : 'Inactiva' }}
                                </span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <button onclick="openEditModal({{ $linea->id }}, '{{ $linea->nombre }}', '{{ $linea->descuento }}', {{ $linea->activa ? 'true' : 'false' }})" 
                                        class="text-indigo-600 hover:text-indigo-900 mr-4">Editar</button>
                                <form method="POST" action="{{ route('admin.lineas.destroy', $linea->id) }}" class="inline" 
                                      onsubmit="return confirm('¿Eliminar esta línea?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-900">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal Crear/Editar Línea -->
<div id="lineaModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4">
        <div class="p-8">
            <h2 id="modalTitle" class="text-2xl font-bold mb-6 text-gray-800">Nueva Línea</h2>
            
            <form id="lineaForm" method="POST">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">

                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nombre de la Línea</label>
                        <input type="text" id="nombre" name="nombre" 
                               class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-indigo-500" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Descuento (%)</label>
                        <input type="text" id="descuento" name="descuento" 
                               class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-indigo-500" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Estado</label>
                        <select id="activa" name="activa" class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-indigo-500">
                            <option value="1">Activa</option>
                            <option value="0">Inactiva</option>
                        </select>
                    </div>
                </div>

                <div class="flex gap-4 mt-10">
                    <button type="button" onclick="closeModal()" 
                            class="flex-1 py-3 border border-gray-300 rounded-xl font-medium text-gray-700 hover:bg-gray-50">
                        Cancelar
                    </button>
                    <button type="submit" 
                            class="flex-1 bg-indigo-600 text-white py-3 rounded-xl font-medium hover:bg-indigo-700">
                        Guardar
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openCreateModal() {
    document.getElementById('modalTitle').textContent = 'Nueva Línea';
    document.getElementById('lineaForm').action = "{{ route('admin.lineas.store') }}";
    document.getElementById('formMethod').value = "POST";
    document.getElementById('nombre').value = '';
    document.getElementById('descuento').value = '';
    document.getElementById('activa').value = '1';
    document.getElementById('lineaModal').classList.remove('hidden');
}

function openEditModal(id, nombre, descuento, activa) {
    document.getElementById('modalTitle').textContent = 'Editar Línea';
    document.getElementById('lineaForm').action = "{{ url('/admin/lineas') }}/" + id;
    document.getElementById('formMethod').value = "PUT";
    document.getElementById('nombre').value = nombre;
    document.getElementById('descuento').value = descuento;
    document.getElementById('activa').value = activa ? '1' : '0';
    document.getElementById('lineaModal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('lineaModal').classList.add('hidden');
}
</script>
@endsection