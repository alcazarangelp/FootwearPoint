@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg">
            <div class="p-6 border-b flex justify-between items-center">
                <h1 class="text-3xl font-bold text-gray-800">Gestión de Usuarios</h1>
                <button onclick="openCreateModal()" 
                        class="bg-indigo-600 hover:bg-indigo-700 text-white px-5 py-2.5 rounded-lg font-medium flex items-center gap-2">
                    <span>+</span> Nuevo Usuario
                </button>
            </div>

            <!-- Mensajes -->
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
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Email</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rol</th>
                            <th class="px-6 py-3 text-center text-xs font-medium text-gray-500 uppercase">Acciones</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($users as $user)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->name }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">{{ $user->email }}</td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <span class="px-3 py-1 text-xs font-medium rounded-full bg-blue-100 text-blue-800">
                                    {{ ucfirst($user->role->name ?? 'Sin rol') }}
                                </span>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-center text-sm font-medium">
                                <button onclick="openEditModal({{ $user->id }}, '{{ $user->name }}', '{{ $user->email }}', {{ $user->role_id }})" 
                                        class="text-indigo-600 hover:text-indigo-900 mr-4">Editar</button>
                                <form method="POST" action="{{ route('admin.users.destroy', $user->id) }}" class="inline" 
                                      onsubmit="return confirm('¿Eliminar este usuario?')">
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

<!-- Modal Crear/Editar -->
<div id="userModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4">
        <div class="p-8">
            <h2 id="modalTitle" class="text-2xl font-bold mb-6 text-gray-800">Nuevo Usuario</h2>
            
            <form id="userForm" method="POST">
                @csrf
                <input type="hidden" name="_method" id="formMethod" value="POST">

                <div class="space-y-6">
                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Nombre</label>
                        <input type="text" id="name" name="name" 
                               class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-indigo-500" required>
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" id="email" name="email" 
                               class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-indigo-500" required>
                    </div>

                    <div id="passwordField">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Contraseña</label>
                        <input type="password" id="password" name="password" 
                               class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-indigo-500">
                    </div>

                    <div>
                        <label class="block text-sm font-medium text-gray-700 mb-1">Rol</label>
                        <select id="role_id" name="role_id" 
                                class="w-full border border-gray-300 rounded-xl px-4 py-3 focus:outline-none focus:border-indigo-500" required>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}">{{ ucfirst($role->name) }}</option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="flex gap-4 mt-10">
                    <button type="button" onclick="closeModal()" 
                            class="flex-1 py-3.5 border border-gray-300 rounded-xl font-medium text-gray-700 hover:bg-gray-50">
                        Cancelar
                    </button>
                    <button type="submit" 
                            class="flex-1 bg-indigo-600 text-white py-3.5 rounded-xl font-medium hover:bg-indigo-700">
                        Guardar Cambios
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openCreateModal() {
    document.getElementById('modalTitle').textContent = 'Nuevo Usuario';
    document.getElementById('userForm').action = "{{ route('admin.users.store') }}";
    document.getElementById('formMethod').value = "POST";
    document.getElementById('name').value = '';
    document.getElementById('email').value = '';
    document.getElementById('password').value = '';
    document.getElementById('passwordField').style.display = 'block';
    document.getElementById('userModal').classList.remove('hidden');
}

function openEditModal(id, name, email, roleId) {
    document.getElementById('modalTitle').textContent = 'Editar Usuario';
    document.getElementById('userForm').action = "{{ url('/admin/users') }}/" + id;
    document.getElementById('formMethod').value = "PUT";
    document.getElementById('name').value = name;
    document.getElementById('email').value = email;
    document.getElementById('role_id').value = roleId;
    document.getElementById('passwordField').style.display = 'none';
    document.getElementById('userModal').classList.remove('hidden');
}

function closeModal() {
    document.getElementById('userModal').classList.add('hidden');
}
</script>
@endsection