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
                        <!-- Usuarios totales -->
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="font-semibold text-gray-600">Usuarios Totales</h3>
                            <p class="text-5xl font-bold text-indigo-600 mt-2">{{ \App\Models\User::count() }}</p>
                        </div>

                        <!-- Distribuidoras -->
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="font-semibold text-gray-600">Distribuidoras</h3>
                            <p class="text-5xl font-bold text-indigo-600 mt-2">
                                {{ \App\Models\User::whereHas('role', function ($q) {$q->where('name', 'distribuidora');})->count() }}
                            </p>
                        </div>

                        <!-- Pedidos Hoy -->
                        <div class="bg-gray-50 p-6 rounded-lg">
                            <h3 class="font-semibold text-gray-600">Pedidos Hoy</h3>
                            <p class="text-5xl font-bold text-indigo-600 mt-2">0</p>
                            <p class="text-xs text-gray-500 mt-1">(Próximamente)</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
