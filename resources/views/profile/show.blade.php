<!-- resources/views/profile/show.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-semibold mb-4">Mi perfil</h1>
        
        <div class="bg-white p-6 rounded-lg shadow-lg">
            <h2 class="text-2xl font-semibold mb-2">Información personal</h2>
            <p><strong>Nombre:</strong> {{ $user->name }}</p>
            <p><strong>Correo electrónico:</strong> {{ $user->email }}</p>
            <p><strong>Fecha de creación:</strong> {{ $user->created_at->format('d/m/Y') }}</p>
            
            <!-- Aquí podrías agregar más campos del perfil si es necesario -->
        </div>
        
        <div class="mt-6">
            <a href="{{ route('profile.edit') }}" class="text-blue-500">Editar perfil</a>
        </div>
    </div>
@endsection
