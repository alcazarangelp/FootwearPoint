@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6 text-gray-900">
                <h1 class="text-3xl font-bold mb-4">Panel de Administrador</h1>
                <p class="text-lg">Bienvenido, <strong>{{ Auth::user()->name }}</strong></p>
                <p class="mt-2 text-gray-600">Rol: Admin</p>
                
                <div class="mt-8 grid grid-cols-1 md:grid-cols-3 gap-6">
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="font-semibold">Usuarios</h3>
                        <p class="text-4xl font-bold text-indigo-600 mt-2">245</p>
                    </div>
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="font-semibold">Distribuidoras</h3>
                        <p class="text-4xl font-bold text-indigo-600 mt-2">18</p>
                    </div>
                    <div class="bg-gray-50 p-6 rounded-lg">
                        <h3 class="font-semibold">Pedidos Hoy</h3>
                        <p class="text-4xl font-bold text-indigo-600 mt-2">47</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection