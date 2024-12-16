@extends('layouts.app')

@section('content')
    <div class="max-w-5xl mx-auto px-6 py-8">
        <div class="mb-6">
            <h2 class="text-lg font-bold text-gray-700 uppercase tracking-widest">
                Resumen de tu vuelo
            </h2>
        </div>

        <div class="bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden">
            <div class="flex justify-between items-center p-4 border-b border-gray-200">
                <div>
                    <span class="text-gray-700 text-lg font-normal">{{ $flight->flight_number ?? 'No disponible' }}</span>
                </div>
                <div>
                    <img src="{{ asset('storage/images/Logo-black.svg') }}" alt="JetVoyager" class="h-6">
                </div>
            </div>

            <div class="grid grid-cols-2 md:grid-cols-4 divide-x divide-gray-200 text-center">
                <div class="p-4">
                    <p class="text-xs text-gray-500 uppercase">Ida</p>
                    @php
                        $horaSalida = 'No disponible';
                        try {
                            $horaSalida = $flight->departure_time
                                ? \Carbon\Carbon::parse(trim($flight->departure_time))->format('H:i')
                                : 'No disponible';
                        } catch (\Exception $e) {
                            $horaSalida = 'No disponible';
                        }
                    @endphp
                    <p class="text-lg text-gray-800">{{ $horaSalida }}</p>
                </div>
                <div class="p-4">
                    <p class="text-xs text-gray-500 uppercase">Llegada</p>
                    @php
                        $horaLlegada = 'No disponible';
                        try {
                            $horaLlegada = $flight->arrival_time
                                ? \Carbon\Carbon::parse(trim($flight->arrival_time))->format('H:i')
                                : 'No disponible';
                        } catch (\Exception $e) {
                            $horaLlegada = 'No disponible';
                        }
                    @endphp
                    <p class="text-lg text-gray-800">{{ $horaLlegada }}</p>
                </div>
                <div class="p-4">
                    <p class="text-xs text-gray-500 uppercase">Duración</p>
                    <p class="text-lg font-semibold text-gray-800">
                        {{ isset($flight->duracion) ? str_replace(':', ' h ', \Illuminate\Support\Str::beforeLast($flight->duracion, ':')) . ' min' : 'No disponible' }}
                    </p>
                </div>
                <div class="p-4">
                    <p class="text-xs text-gray-500 uppercase">Precio</p>
                    <p class="text-2xl text-gray-800">
                        {{ isset($flight->base_price) ? number_format($flight->base_price, 2, ',', '.') . ' EUR' : 'No disponible' }}
                    </p>
                </div>
            </div>
        </div>

        <section class="mt-20 flex flex-col justify-center items-center">
            <h2 class="text-2xl font-semibold">AHORRA CON TU TARIFA</h2>
            <h3 class="text-xl font-light">AÑADE TUS EXTRAS FAVORITOS Y VUELA AL MEJOR PRECIO</h3>
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mt-8">
                <!-- Plan JetLite -->
                <div
                    class="bg-white border border-gray-200 rounded-lg shadow-sm p-6 text-center flex flex-col transition-transform duration-300 ease-in-out hover:scale-105">
                    <h3 class="text-lg font-bold text-gray-800">JetLite</h3>
                    <p class="text-sm text-gray-500 mt-2">Vuela ligero, viaja feliz.</p>
                    <hr class="my-4 border-gray-300">
                    <ul class="space-y-2 text-left">
                        <li class="flex items-center text-gray-600">
                            <img src="{{ asset('storage/images/icons/backpack.svg') }}" alt="JetVoyager" class="h-6 mr-3">
                            <span>Equipaje de mano: 1 pieza bajo el asiento (Máx. 40x20x30 cm)</span>
                        </li>
                        <li class="flex items-center text-gray-600">
                            <img src="{{ asset('storage/images/icons/suitcase.svg') }}" alt="JetVoyager" class="h-6 mr-3">
                            <span>Maleta facturada: Hasta 20 kg</span>
                        </li>
                    </ul>
                    <div class="mt-auto">
                        <a href="{{ route('flight.confirmar-vuelo', [
                            'flight' => $flight->id, 
                            'plan' => 'JetLite', 
                            'originIATA' => $flight->origin_city_iata, 
                            'destinationIATA' => $flight->destination_city_iata, 
                            'price' => $flight->base_price 
                        ]) }}" class="text-md font-bold bg-yellow hover:bg-yellow-hover rounded-full px-4 py-3 mt-4">
                            + 35,00 EUR/PERSONA
                        </a>

                        <p class="text-sm text-gray-500">sobre el precio del billete</p>
                    </div>
                </div>

                <!-- Plan JetPremium (destacado) -->
                <div
                    class="bg-white border-4 border-yellow rounded-lg shadow-lg p-6 text-center flex flex-col transition-transform duration-300 ease-in-out hover:scale-105">
                    <h3 class="text-xl font-bold text-black">JetPremium</h3>
                    <p class="text-sm text-black mt-2">Todo lo que necesitas.</p>
                    <hr class="my-4 border-gray-300">
                    <ul class="space-y-2 text-left">
                        <li class="flex items-center text-gray-600">
                            <img src="{{ asset('storage/images/icons/backpack.svg') }}" alt="JetVoyager" class="h-6 mr-3">
                            <span>Equipaje de mano: 1 pieza bajo el asiento (Máx. 40x20x30 cm)</span>
                        </li>
                        <li class="flex items-center text-gray-600">
                            <img src="{{ asset('storage/images/icons/suitcase.svg') }}" alt="JetVoyager" class="h-6 mr-3">
                            <span>Maleta facturada: ¡Hasta 50 kg! Lleva todo lo que necesitas para tu aventura.</span>
                        </li>
                        <li class="flex items-center text-gray-600">
                            <img src="{{ asset('storage/images/icons/seat.png') }}" alt="JetVoyager" class="h-6 mr-3">
                            <span>Elige tu asiento</span>
                        </li>
                        <li class="flex items-center text-gray-600">
                            <img src="{{ asset('storage/images/icons/change.svg') }}" alt="JetVoyager" class="h-6 mr-3">
                            <span>Cambios y cancelación</span>
                        </li>
                    </ul>
                    <div class="mt-auto">
                        <a href="{{ route('flight.confirmar-vuelo', [
                            'flight' => $flight->id, 
                            'plan' => 'JetPremium', 
                            'originIATA' => $flight->origin_city_iata, 
                            'destinationIATA' => $flight->destination_city_iata, 
                            'price' => $flight->base_price 
                        ]) }}" class="text-md font-bold bg-yellow hover:bg-yellow-hover rounded-full px-4 py-3 mt-4">
                            + 84,00 EUR/PERSONA
                        </a>
                        <p class="text-sm text-gray-500">sobre el precio del billete</p>
                    </div>
                </div>

                <!-- Plan JetClassic -->
                <div
                    class="bg-white border border-gray-200 rounded-lg shadow-sm p-6 text-center flex flex-col transition-transform duration-300 ease-in-out hover:scale-105">
                    <h3 class="text-lg font-bold text-gray-800">JetClassic</h3>
                    <p class="text-sm text-gray-500 mt-2">Más espacio, más comodidad.</p>
                    <hr class="my-4 border-gray-300">
                    <ul class="space-y-2 text-left">
                        <li class="flex items-center text-gray-600">
                            <img src="{{ asset('storage/images/icons/backpack.svg') }}" alt="JetVoyager" class="h-6 mr-3">
                            <span>1 pieza de equipaje de mano bajo el asiento (Máx. 40x20x30 cm)</span>
                        </li>
                        <li class="flex items-center text-gray-600">
                            <img src="{{ asset('storage/images/icons/suitcase.svg') }}" alt="JetVoyager" class="h-6 mr-3">
                            <span>1 pieza de equipaje en el compartimiento superior</span>
                        </li>
                        <li class="flex items-center text-gray-600">
                            <img src="{{ asset('storage/images/icons/change.svg') }}" alt="JetVoyager" class="h-6 mr-3">
                            <span>Reembolso parcial ante cancelaciones</span>
                        </li>
                    </ul>
                    <div class="mt-auto">
                        <a href="{{ route('flight.confirmar-vuelo', [
                            'flight' => $flight->id, 
                            'plan' => 'JetClassic', 
                            'originIATA' => $flight->origin_city_iata, 
                            'destinationIATA' => $flight->destination_city_iata, 
                            'price' => $flight->base_price 
                        ]) }}" class="text-md font-bold bg-yellow hover:bg-yellow-hover rounded-full px-4 py-3 mt-4">
                            + 60,00 EUR/PERSONA
                        </a>

                        <p class="text-sm text-gray-500">sobre el precio del billete</p>
                    </div>
                </div>
            </div>
        </section>

    </div>
@endsection
