@extends('layouts.app')

@section('content')
    <div class="container mx-auto mt-10">
        <h1 class="text-2xl font-bold mb-4">Asignar Destino Popular</h1>

        <!-- Formulario para asignar destino popular -->
        <form action="{{ route('popular-destinations.store') }}" method="POST">
            @csrf

            <!-- Campo para seleccionar la ciudad -->
            <div class="mb-4">
                <label for="city_id" class="block text-sm font-medium text-gray-700">Selecciona una Ciudad</label>
                <select name="city_id" id="city_id" class="block w-full mt-2 p-2 border border-gray-300 rounded-md">
                    <option value="">Selecciona una ciudad</option>
                    @foreach ($ciudades as $ciudad)
                        <option value="{{ $ciudad->id }}">{{ $ciudad->name }}</option>
                    @endforeach
                </select>

                <!-- Mensaje de error -->
                @error('city_id')
                    <div class="text-red-500 text-sm mt-2">{{ $message }}</div>
                @enderror
            </div>

            <!-- Campo para descripción del destino (opcional) -->
            <div class="mb-4">
                <label for="descripcion" class="block text-sm font-medium text-gray-700">Descripción del Destino (opcional)</label>
                <textarea name="descripcion" id="descripcion" rows="3" class="block w-full mt-2 p-2 border border-gray-300 rounded-md"></textarea>
            </div>

            <!-- Botón para crear el destino -->
            <div class="mb-4">
                <button type="submit" class="bg-blue-600 text-white p-2 rounded-md">Asignar como Destino Popular</button>
            </div>
        </form>
    </div>
@endsection
