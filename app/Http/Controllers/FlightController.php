<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\City;
use App\Models\Airport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class FlightController extends Controller
{
    /**
     * Mostrar todos los vuelos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $flights = Flight::all();
        return response()->json($flights);
    }

    /**
     * Mostrar un vuelo específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($flight_id, Request $request)
    {
        // Obtener el vuelo con sus relaciones
        $flight = Flight::with(['originAirport', 'destinationAirport'])->findOrFail($flight_id);

        // Obtener el plan seleccionado, dependiendo de cómo lo manejes (puede ser un parámetro en la URL o alguna lógica adicional)
        // Aquí se asume que el plan es un parámetro en la URL o de otro tipo, pero ajusta según tu lógica
        $plan = $request->input('plan'); // Esto es solo un ejemplo, puedes obtenerlo como desees

        // Pasar los datos del vuelo y el plan a la vista
        return view('flight.show', compact('flight', 'plan'));
    }
    public function confirmarVuelo($flight, $plan, Request $request)
    {
        // Encuentra el vuelo por su ID
        $flight = Flight::with(['originAirport', 'destinationAirport'])->findOrFail($flight); // Asegúrate de usar 'with'

        // Obtén el resto de los parámetros desde la URL y la query string
        $originIATA = $flight->originAirport->code_iata; // Accede al código IATA del aeropuerto de origen
        $destinationIATA = $flight->destinationAirport->code_iata; // Accede al código IATA del aeropuerto de destino
        $price = $request->input('price');

        // Lógica para establecer el precio del plan
        switch ($plan) {
            case 'JetLite':
                $planPrice = 35.00;
                break;
            case 'JetPremium':
                $planPrice = 84.00;
                break;
            case 'JetClassic':
                $planPrice = 60.00;
                break;
            default:
                $planPrice = 0.00;
                break;
        }

        return view('flight.confirmar-vuelo', compact('flight', 'plan', 'originIATA', 'destinationIATA', 'price', 'planPrice'));
    }


    public function search(Request $request)
{
    // 1️⃣ Capturar los parámetros del formulario
    $tipoViaje = $request->input('tipo_viaje'); // 'ida' o 'ida_vuelta'
    $origen = $request->input('origin');
    $destino = $request->input('destination');
    $fechaIda = $request->input('departure');
    $fechaVuelta = $request->input('return_date');

    // 2️⃣ Registrar los parámetros recibidos
    Log::info('Parámetros de búsqueda:', [
        'tipo_viaje' => $tipoViaje,
        'origen' => $origen,
        'destino' => $destino,
        'fecha_ida' => $fechaIda,
        'fecha_vuelta' => $fechaVuelta
    ]);

    // 3️⃣ Obtener los IDs de los aeropuertos de origen y destino usando los códigos IATA
    $origenId = Airport::where('code_iata', strtoupper($origen))->value('id'); // Aseguramos que el código esté en mayúsculas
    $destinoId = Airport::where('code_iata', strtoupper($destino))->value('id'); // Aseguramos que el código esté en mayúsculas

    // 4️⃣ Verificar que los códigos de aeropuerto existan
    if (!$origenId || !$destinoId) {
        return response()->json(['error' => 'Código de aeropuerto no válido.'], 400);
    }

    // 5️⃣ Buscar los vuelos de ida
    $vuelosIda = collect(Flight::where('origin_airport_id', $origenId)
        ->where('destination_airport_id', $destinoId)
        ->where('flight_date', $fechaIda)
        ->orderBy('departure_time', 'asc')
        ->get());

    // 6️⃣ Si el usuario eligió "ida y vuelta", buscar los vuelos de regreso
    $vuelosVuelta = collect([]);
    if ($tipoViaje === 'ida_vuelta' && $fechaVuelta) {
        $vuelosVuelta = collect(Flight::where('origin_airport_id', $destinoId) // Origen y destino invertidos
            ->where('destination_airport_id', $origenId)
            ->where('flight_date', $fechaVuelta)
            ->orderBy('departure_time', 'asc')
            ->get());
        
        // Log de los vuelos de vuelta
        Log::info('Vuelos de vuelta encontrados:', $vuelosVuelta->toArray());
    }

    // 7️⃣ Retornar la vista de resultados
    return view('flight.results', [
        'vuelosIda' => $vuelosIda,
        'vuelosVuelta' => $vuelosVuelta,
        'tipoViaje' => $tipoViaje
    ]);
}





    /**
     * Crear un nuevo vuelo.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'airplane_id' => 'required|exists:airplanes,id',
            'origin_airport_id' => 'required|exists:airports,id',
            'destination_airport_id' => 'required|exists:airports,id',
            'departure_time' => 'required|date',
            'arrival_time' => 'required|date',
            'base_price' => 'required|numeric',
            'status' => 'nullable|in:scheduled,canceled,completed',
        ]);

        $flight = Flight::create($request->all());

        return response()->json($flight, 201);
    }

    /**
     * Actualizar un vuelo específico.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $flight = Flight::findOrFail($id);
        $flight->update($request->all());

        return response()->json($flight);
    }

    /**
     * Eliminar un vuelo específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $flight = Flight::findOrFail($id);
        $flight->delete();

        return response()->json(['message' => 'Flight deleted successfully']);
    }

    // FlightController.php
    public function getArrivals($airportId)
    {
        // Suponiendo que tienes un modelo Flight que se conecta con la tabla 'flights'
        $arrivals = Flight::where('destination_airport_id', $airportId)->get();

        // Devolver los vuelos que llegan
        return response()->json($arrivals);
    }


    // FlightController.php
    public function getDepartures($airportId)
    {
        // Suponiendo que tienes un modelo Flight que se conecta con la tabla 'flights'
        $departures = Flight::where('origin_airport_id', $airportId)->get();

        // Devolver los vuelos que salen
        return response()->json($departures);
    }

    public function getFlightsByCity($cityId)
    {
        // Obtener la ciudad
        $city = City::findOrFail($cityId);

        // Obtener los vuelos asociados a los aeropuertos de la ciudad
        $flights = $city->airports()->with('flights')->get()->flatMap(function ($airport) {
            return $airport->flights; // Obtener todos los vuelos de los aeropuertos
        });

        // Devolver los vuelos en formato JSON
        return response()->json($flights);
    }
}
