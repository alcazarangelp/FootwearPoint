@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white shadow-sm sm:rounded-lg p-6">
            <h1 class="text-2xl font-bold mb-6">
                {{ isset($user) ? 'Editar Usuario' : 'Crear Nuevo Usuario' }}
            </h1>

            <form method="POST" action="{{ isset($user) ? route('admin.users.update', $user->id) : route('admin.users.store') }}">
                @csrf
                @if(isset($user))
                    @method('PUT')
                @endif

                <div class="mb-4">
                    <label class="block mb-1">Nombre</label>
                    <input type="text" name="name" 
                           value="{{ old('name', $user->name ?? '') }}" 
                           class="w-full border p-3 rounded focus:outline-none focus:border-indigo-500" required>
                </div>

                <div class="mb-4">
                    <label class="block mb-1">Email</label>
                    <input type="email" name="email" 
                           value="{{ old('email', $user->email ?? '') }}" 
                           class="w-full border p-3 rounded focus:outline-none focus:border-indigo-500" required>
                </div>

                @if(!isset($user))
                <div class="mb-4">
                    <label class="block mb-1">Contraseña</label>
                    <input type="password" name="password" 
                           class="w-full border p-3 rounded focus:outline-none focus:border-indigo-500" required>
                </div>
                @endif

                <div class="mb-4">
                    <label class="block mb-1">Rol</label>
                    <select name="role_id" class="w-full border p-3 rounded focus:outline-none focus:border-indigo-500" required>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}" 
                                {{ (isset($user) && $user->role_id == $role->id) ? 'selected' : '' }}>
                                {{ ucfirst($role->name) }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex gap-4">
                    <button type="submit" class="bg-indigo-600 text-white px-6 py-3 rounded hover:bg-indigo-700">
                        {{ isset($user) ? 'Actualizar' : 'Crear' }} Usuario
                    </button>
                    <a href="{{ route('admin.users.index') }}" class="bg-gray-500 text-white px-6 py-3 rounded hover:bg-gray-600">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection