@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto px-6 py-12 flex flex-col md:flex-row gap-8">
        <!-- Columna izquierda - Formulario -->
        <div class="w-full md:w-2/3">
            <h2 class="text-3xl font-bold text-gray-900 mb-8">¿QUIÉN VIAJARÁ CONTIGO?</h2>

            <div class="space-y-6">
                <div class="flex items-center gap-2 mb-6">
                    <div class="w-8 h-8 bg-gray-900 rounded-full flex items-center justify-center">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" viewBox="0 0 20 20"
                            fill="currentColor">
                            <path fill-rule="evenodd" d="M10 9a3 3 0 100-6 3 3 0 000 6zm-7 9a7 7 0 1114 0H3z"
                                clip-rule="evenodd" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-semibold">ADULTO 1</h3>
                </div>

                <!-- Formulario de datos del pasajero -->
                <form class="space-y-6">
                    <div class="space-y-4">
                        <div>
                            <input type="text" name="nombre" id="nombre" placeholder="Nombre"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-gray-500 focus:ring-0 text-gray-900"
                                required>
                        </div>

                        <div>
                            <input type="text" name="apellidos" id="apellidos" placeholder="Apellidos"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-gray-500 focus:ring-0 text-gray-900"
                                required>
                        </div>

                        <div>
                            <select name="pais_residencia" id="pais_residencia"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-gray-500 focus:ring-0 text-gray-900 appearance-none bg-white"
                                required>
                                <option value="" disabled selected>País de residencia</option>
                                <option value="es">España</option>
                                <option value="fr">Francia</option>
                                <option value="de">Alemania</option>
                                <!-- Añade más países según sea necesario -->
                            </select>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div>
                                <select name="prefijo" id="prefijo"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-gray-500 focus:ring-0 text-gray-900 appearance-none bg-white"
                                    required>
                                    <option value="" disabled selected>Prefijo</option>
                                    <option value="+34">+34</option>
                                    <option value="+33">+33</option>
                                    <option value="+49">+49</option>
                                    <!-- Añade más prefijos según sea necesario -->
                                </select>
                            </div>
                            <div>
                                <input type="tel" name="telefono" id="telefono" placeholder="Teléfono móvil"
                                    class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-gray-500 focus:ring-0 text-gray-900"
                                    required>
                            </div>
                        </div>

                        <div>
                            <input type="email" name="email" id="email" placeholder="Email"
                                class="w-full px-4 py-3 rounded-lg border border-gray-300 focus:border-gray-500 focus:ring-0 text-gray-900"
                                required>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Columna derecha - Resumen -->
        <div class="w-full md:w-1/3">
            <div class="bg-white rounded-2xl border border-gray-200 overflow-hidden">
                <!-- Cabecera del resumen -->
                <div class="bg-black text-white p-4">
                    <h3 class="text-lg font-medium">Tu itinerario</h3>
                </div>

                <!-- Contenido del resumen -->
                <div class="p-4 space-y-6">
                    <!-- Detalles del vuelo con línea de tiempo -->
                    <div class="space-y-4">
                        <div class="flex justify-between items-center">
                            <span class="text-2xl font-medium">{{ $originIATA }}</span>
                            <span
                                class="text-gray-600">{{ \Carbon\Carbon::parse($flight->departure_time)->format('d/m/Y') }}</span>
                            <span class="text-2xl font-medium">{{ $destinationIATA }}</span>
                        </div>

                        <div class="relative flex justify-between items-center px-2">
                            <span class="text-lg">{{ \Carbon\Carbon::parse($flight->departure_time)->format('H:i') }}
                                H</span>
                            <div class="absolute left-[20%] right-[20%] top-1/2 transform -translate-y-1/2">
                                <div class="relative h-[2px] bg-gray-300">
                                    <div
                                        class="absolute left-0 top-1/2 transform -translate-y-1/2 -translate-x-1/2 w-3 h-3 bg-white border-2 border-gray-300 rounded-full">
                                    </div>
                                    <div
                                        class="absolute right-0 top-1/2 transform -translate-y-1/2 translate-x-1/2 w-3 h-3 bg-white border-2 border-gray-300 rounded-full">
                                    </div>
                                </div>
                            </div>
                            <span class="text-lg">{{ \Carbon\Carbon::parse($flight->arrival_time)->format('H:i') }} H</span>
                        </div>

                        <div class="flex justify-between items-center mt-4">
                            <span class="text-xl font-medium">IDA</span>
                            <span class="text-xl font-medium">{{ number_format($flight->base_price, 2, ',', '.') }}
                                EUR</span>
                        </div>
                    </div>

                    <!-- Plan seleccionado -->
                    <div class="border-t pt-4">
                        <div class="flex justify-between items-center mb-2">
                            <span>1 tarifa {{ $plan }}</span>
                            <span class="font-medium">+ {{ number_format($planPrice, 2, ',', '.') }} EUR</span>
                        </div>

                        <!-- Aquí usas un condicional para mostrar los detalles del plan -->
                        <ul class="text-sm text-gray-600 space-y-2">
                            @if ($plan === 'JetLite')
                                <li>Equipaje de mano: 1 pieza bajo el asiento (Máx. 40x20x30 cm).</li>
                                <li>Maleta facturada: Hasta 20 kg.</li>
                            @elseif($plan === 'JetPremium')
                                <li>Equipaje de mano: 1 pieza bajo el asiento (Máx. 40x20x30 cm).</li>
                                <li>Maleta facturada: ¡Hasta 50 kg! Lleva todo lo que necesitas para tu aventura.</li>
                                <li>Elige tu asiento.</li>
                                <li>Cambios y cancelación.</li>
                            @elseif($plan === 'JetClassic')
                                <li>Equipaje de mano: 1 pieza bajo el asiento (Máx. 40x20x30 cm).</li>
                                <li>1 pieza de equipaje en el compartimiento superior.</li>
                                <li>Reembolso parcial ante cancelaciones.</li>
                            @else
                                <li>Consulta los detalles de tu plan.</li>
                            @endif
                        </ul>
                    </div>

                    <!-- Precio final -->
                    <div class="bg-black text-white p-4 -mx-4">
                        <div class="flex justify-between items-center">
                            <span class="font-medium">PRECIO FINAL</span>
                            <span class="font-medium">{{ number_format($flight->base_price + $planPrice, 2, ',', '.') }}
                                EUR</span>
                        </div>
                    </div>

                    <!-- Nota de precio claro -->
                    <div class="text-center">
                        <p class="font-medium">Precio claro</p>
                        <p class="text-sm text-gray-500">Todas las tasas y comisiones están cubiertas en el precio final.
                        </p>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection
