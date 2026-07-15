@extends('layouts.app')

@section('content')
<div class="py-12">
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
            <div class="p-6">
                <h1 class="text-3xl font-bold text-gray-900">Panel de Mayorista</h1>
                <p class="mt-4">Bienvenido, {{ auth()->user()->name }}</p>
            </div>
        </div>
    </div>
</div>
@endsection