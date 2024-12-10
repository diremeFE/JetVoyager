<?php

namespace App\Http\Controllers;

use App\Models\PopularDestination;
use App\Models\City;
use App\Models\Flight;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


class PopularDestinationController extends Controller
{
    /**
     * Listar todos los destinos populares.
     */
    public function index()
    {
        // Obtener todos los destinos populares, con sus ciudades
        $destinos = PopularDestination::with('city')->take(3)->get();

        return view('welcome', compact('destinos'));
    }

    public function indexAll()
    {
        // Obtener todos los destinos populares, con sus ciudades
        $destinos = PopularDestination::with('city')->get();  // No hay límite aquí, obtenemos todos los destinos

        return view('popular-destinations.index', compact('destinos')); // Pasamos 'destinos', no 'destinosPopulares'
    }

    public function getClientCity()
    {
        try {
            $ipData = file_get_contents('https://ipinfo.io/json');
            $data = json_decode($ipData, true);

            return $data['city'] ?? null; // Devolvemos la ciudad o null si no se encuentra
        } catch (\Exception $e) {
            return null; // En caso de error, devolvemos null
        }
    }


    /**
     * Mostrar un destino popular específico.
     */

    public function show($city_id)
    {
        // Obtener la ciudad destino por city_id
        $destino = PopularDestination::with('city')->where('city_id', $city_id)->first();

        if (!$destino) {
            return redirect('/')->with('error', 'Destino no encontrado.');
        }

        $ip = request()->ip();
        Log::info("IP del usuario: {$ip}");

        // Simular IP local
        if ($ip == '127.0.0.1') {
            $origen = 'Valencia';
            Log::info("Simulando IP local. Ciudad de origen: {$origen}");
        } else {
            $url = "http://ip-api.com/json/{$ip}";
            $response = file_get_contents($url);
            Log::info("Respuesta de la API de geolocalización: {$response}");
            $data = json_decode($response);
            $origen = $data->city ?? 'Desconocida';
            Log::info("Ciudad de origen basada en la IP: {$origen}");
        }

        $origenAirport = DB::table('airports')
            ->join('cities', 'airports.city_id', '=', 'cities.id')
            ->where('cities.name', $origen)
            ->first();

        if (!$origenAirport) {
            return redirect('/')->with('error', 'Aeropuerto de origen no encontrado.');
        }

        $destinoAirport = DB::table('airports')
            ->join('cities', 'airports.city_id', '=', 'cities.id')
            ->where('cities.name', $destino->city->name)
            ->first();

        if (!$destinoAirport) {
            return redirect('/')->with('error', 'Aeropuerto de destino no encontrado.');
        }

        // Consultar vuelos disponibles para el origen y destino
        $vuelos = DB::table('flights')
            ->join('airports as origin', 'flights.origin_airport_id', '=', 'origin.id')
            ->join('airports as destination', 'flights.destination_airport_id', '=', 'destination.id')
            ->select(
                'flights.id',
                'flights.flight_date',
                'flights.departure_time',
                'flights.arrival_time',
                'flights.base_price',
                'flights.flight_number',
                'flights.total_duration AS duracion',
                'flights.stopovers_count AS escalas',
                'origin.city_id as origin_city_id',
                'destination.city_id as destination_city_id',
                'origin.code_iata as origin_city_iata',  // Cambiado de iata_code a code_iata
                'destination.code_iata as destination_city_iata'  // Cambiado de iata_code a code_iata
            )
            ->where('origin.city_id', $origenAirport->city_id)
            ->where('destination.city_id', $destinoAirport->city_id)
            ->get();



        // Comprobar si hay vuelos disponibles y si cada vuelo tiene la propiedad 'flight_number'
        foreach ($vuelos as $vuelo) {
            if (!isset($vuelo->flight_number)) {
                Log::warning("El vuelo con ID {$vuelo->id} no tiene número de vuelo.");
                $vuelo->flight_number = 'Número de vuelo no disponible';
            }
        }

        return view('popular-destinations.show', compact('destino', 'vuelos', 'origenAirport', 'destinoAirport'));
    }

    public function getFlightsByDate($fecha)
    {
        // Filtrar vuelos según la fecha seleccionada
        $vuelos = DB::table('flights')
            ->join('airports as origin', 'flights.origin_airport_id', '=', 'origin.id')
            ->join('airports as destination', 'flights.destination_airport_id', '=', 'destination.id')
            ->select(
                'flights.id',
                'flights.flight_date',
                'flights.departure_time',
                'flights.arrival_time',
                'flights.base_price',
                'flights.flight_number',
                'flights.total_duration AS duracion',
                'flights.stopovers_count AS escalas',
                'origin.city_id as origin_city_id',
                'destination.city_id as destination_city_id',
                'origin.iata_code AS origin_city_iata',
                'destination.iata_code AS destination_city_iata',
                'airlines.logo_url AS airline_logo'
            )
            ->where('flights.flight_date', $fecha)
            ->get();

        return response()->json(['vuelos' => $vuelos]);
    }


    public function mostrarVuelos($fecha)
    {
        // Obtener los vuelos de la fecha seleccionada
        $vuelos = Flight::where('flight_date', $fecha)
            ->with('airline', 'origin.city', 'destination.city')
            ->get();

        // Devolver los vuelos en formato JSON
        return response()->json(['vuelos' => $vuelos]);
    }


    public function create()
    {
        // Obtener todas las ciudades para asignar en un destino popular
        $ciudades = City::all();
        return view('popular-destinations.create', compact('ciudades'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'city_id' => 'required|exists:cities,id',
            'descripcion' => 'nullable|string',
        ]);

        // Guardamos el destino popular
        PopularDestination::create([
            'city_id' => $request->city_id,
            'descripcion' => $request->descripcion,
        ]);

        return redirect()->route('popular-destinations.create')->with('success', 'Destino popular asignado correctamente.');
    }


    /**
     * Actualizar un destino popular existente.
     */
    public function update(Request $request, $id)
    {
        // Eliminamos la validación para 'flight_id' si ya no está en la tabla
        $request->validate([
            'city_id' => 'required|exists:cities,id',
            'descripcion' => 'nullable|string',
        ]);

        $destino = PopularDestination::findOrFail($id);
        $destino->update($request->all());

        return response()->json([
            'message' => 'Destino popular actualizado con éxito.',
            'data' => $destino
        ]);
    }

    /**
     * Eliminar un destino popular.
     */
    public function destroy($id)
    {
        $destino = PopularDestination::findOrFail($id);
        $destino->delete();

        return response()->json(['message' => 'Destino popular eliminado con éxito.']);
    }
}
