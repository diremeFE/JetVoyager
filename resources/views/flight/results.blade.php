@extends('layouts.app')

@section('content')
<div class="container mx-auto py-10">
    <h1 class="text-3xl font-bold text-center mb-6">Resultados de búsqueda</h1>

    <!-- Resultados de la ida -->
    <h2 class="text-2xl font-semibold mb-4">Vuelos de ida</h2>
    @if($vuelosIda->isEmpty())
        <p>No se encontraron vuelos de ida para la fecha seleccionada.</p>
    @else
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($vuelosIda as $vuelo)
                <div class="border p-4 rounded-lg shadow-lg">
                    <p><strong>Número de vuelo:</strong> {{ $vuelo->flight_number }}</p>
                    <p><strong>Hora de salida:</strong> {{ $vuelo->departure_time }}</p>
                    <p><strong>Hora de llegada:</strong> {{ $vuelo->arrival_time }}</p>
                    <p><strong>Duración total:</strong> {{ $vuelo->total_duration }}</p>
                    <p><strong>Precio base:</strong> €{{ $vuelo->base_price }}</p>
                    <p><strong>Estado:</strong> {{ ucfirst($vuelo->status) }}</p>
                </div>
            @endforeach
        </div>
    @endif

    <!-- Resultados de la vuelta (solo si es ida y vuelta) -->
    @if($tipoViaje === 'ida_vuelta')
        <h2 class="text-2xl font-semibold mt-10 mb-4">Vuelos de regreso</h2>
        @if($vuelosVuelta->isEmpty())
            <p>No se encontraron vuelos de regreso para la fecha seleccionada.</p>
        @else
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @foreach($vuelosVuelta as $vuelo)
                    <div class="border p-4 rounded-lg shadow-lg">
                        <p><strong>Número de vuelo:</strong> {{ $vuelo->flight_number }}</p>
                        <p><strong>Hora de salida:</strong> {{ $vuelo->departure_time }}</p>
                        <p><strong>Hora de llegada:</strong> {{ $vuelo->arrival_time }}</p>
                        <p><strong>Duración total:</strong> {{ $vuelo->total_duration }}</p>
                        <p><strong>Precio base:</strong> €{{ $vuelo->base_price }}</p>
                        <p><strong>Estado:</strong> {{ ucfirst($vuelo->status) }}</p>
                    </div>
                @endforeach
            </div>
        @endif
    @endif
</div>
@endsection
