@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-8">
        <div class="w-full flex justify-start items-center mb-5">
            <h2 class="text-gray-600 font-medium text-3xl">✈️ {{ $origenAirport->name ?? 'No disponible' }} a {{ $destinoAirport->name ?? 'No disponible' }}</h2>
        </div>

        <!-- Lista de vuelos -->
        <ul class="flex flex-col">
            @forelse ($vuelos as $vuelo)
                <li class="bg-white rounded-3xl shadow-sm border border-gray-100 overflow-hidden mb-5">
                    <!-- Contenido de la tarjeta -->
                    <div class="p-8">
                        <!-- Información del vuelo (fuera del grid) -->
                        <div class="flex items-center gap-2 mb-6">
                            <span class="text-gray-700 text-lg font-normal">{{ $vuelo->flight_number ?? 'N/A' }}</span>
                            <img src="{{ asset('storage/images/Logo-black.svg') }}" alt="Logo JetVoyager" class="h-6">
                        </div>

                        <!-- Contenedor principal con grid -->
                        <div class="grid grid-cols-[auto_1fr_auto] gap-8 items-center">
                            <!-- Hora y aeropuerto salida -->
                            <div class="flex flex-col items-start">
                                <span class="text-4xl font-light mb-2">
                                    {{ \Carbon\Carbon::createFromFormat('H:i:s', $vuelo->departure_time)->format('H:i') }}
                                </span>
                                <div class="flex items-center">
                                    <div class="w-4 h-4 rounded-full bg-gray-200"></div>
                                    <span class="ml-2 text-gray-500 text-sm">{{ $vuelo->origin_city_iata ?? 'N/A' }}</span>
                                </div>
                            </div>

                            <!-- Contenedor central -->
                            <div class="flex flex-col items-center">
                                <!-- Duración -->
                                <span class="text-gray-500 text-sm mb-4">
                                    {{ isset($vuelo->duracion) ? str_replace(':', ' h ', \Illuminate\Support\Str::beforeLast($vuelo->duracion, ':')) . ' min' : 'No disponible' }}
                                </span>
                                <!-- Línea de conexión -->
                                <div class="w-full relative">
                                    <div class="w-full h-[1px] bg-gray-200"></div>
                                    <div class="absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2">
                                        <span class="text-gray-400">✈️</span>
                                    </div>
                                </div>
                                <!-- Escalas -->
                                <span class="text-gray-600 mt-4">
                                    {{ $vuelo->escalas === 0 ? 'Directo' : $vuelo->escalas . ' escala' . ($vuelo->escalas > 1 ? 's' : '') }}
                                </span>
                            </div>

                            <!-- Hora de llegada -->
                            <div class="flex flex-col items-end">
                                <span class="text-4xl font-light mb-2">
                                    {{ \Carbon\Carbon::createFromFormat('H:i:s', $vuelo->arrival_time)->format('H:i') }}
                                </span>
                                <div class="flex items-center">
                                    <span class="mr-2 text-gray-500 text-sm">{{ $vuelo->destination_city_iata ?? 'N/A' }}</span>
                                    <div class="w-4 h-4 rounded-full bg-gray-200"></div>
                                </div>
                            </div>
                        </div>
                        
                        <!-- Precio (centrado) -->
                        <div class="flex justify-center mt-8">
                            <a href="{{ route('flight.show', ['flight_id' => $vuelo->id, 'originIATA' => $vuelo->origin_city_iata, 'destinationIATA' => $vuelo->destination_city_iata, 'price' => $vuelo->base_price]) }}" class="bg-yellow text-black text-xl font-medium px-6 py-2 rounded-full hover:bg-yellow-hover transition-colors whitespace-nowrap">
                                {{ number_format($vuelo->base_price, 2, ',', '.') }} EUR
                            </a>                           
                        </div>
                    </div>
                </li>
            @empty
                <li class="text-center text-gray-600 font-medium">
                    No se encontraron vuelos disponibles para esta ruta.
                </li>
            @endforelse
        </ul>
    </div>
@endsection