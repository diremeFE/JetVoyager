<?php

namespace App\Http\Controllers;

use App\Models\PopularDestination;
use App\Models\City;
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
    // Registrar el ID de la ciudad para depuración
    Log::info("Intentando obtener el destino con city_id: {$city_id}");

    // Obtener la ciudad destino por city_id
    $destino = PopularDestination::with('city')->where('city_id', $city_id)->first();

    if (!$destino) {
        // Registrar que no se encontró el destino
        Log::warning("No se encontró el destino para city_id: {$city_id}");
        
        // Si no se encuentra el destino, retornar un mensaje o redirigir a la ruta /
        return redirect('/')->with('error', 'Destino no encontrado.');
    }

    // Registrar los detalles del destino encontrado
    Log::info("Destino encontrado: " . $destino->city->name);

    // Obtener la IP del usuario
    $ip = request()->ip();
    Log::info("IP del usuario: {$ip}");

    // Usar una API gratuita para obtener la ciudad basada en la IP
    $url = "http://ip-api.com/json/{$ip}";
    $response = file_get_contents($url);
    $data = json_decode($response);

    // Verificar si la ciudad de origen es válida
    $origen = $data->city ?? 'Desconocida';
    Log::info("Ciudad de origen basada en la IP: {$origen}");

    // Obtener el aeropuerto de origen y destino usando el city_id y un JOIN con la tabla cities
    $origenAirport = DB::table('airports')
        ->join('cities', 'airports.city_id', '=', 'cities.id')
        ->where('cities.name', $origen)  // Usamos 'name' de la tabla 'cities'
        ->first();

    if (!$origenAirport) {
        // Registrar que no se encontró el aeropuerto de origen
        Log::warning("No se encontró el aeropuerto de origen para la ciudad: {$origen}");
        
        // Si no se encuentra el aeropuerto de origen, manejar el error
        return redirect('/')->with('error', 'Aeropuerto de origen no encontrado.');
    }

    Log::info("Aeropuerto de origen encontrado: {$origenAirport->name}");

    $destinoAirport = DB::table('airports')
        ->join('cities', 'airports.city_id', '=', 'cities.id')
        ->where('cities.name', $destino->city->name)  // Usamos 'name' de la tabla 'cities'
        ->first();

    if (!$destinoAirport) {
        // Registrar que no se encontró el aeropuerto de destino
        Log::warning("No se encontró el aeropuerto de destino para la ciudad: {$destino->city->name}");

        // Si no se encuentra el aeropuerto de destino, manejar el error
        return redirect('/')->with('error', 'Aeropuerto de destino no encontrado.');
    }

    Log::info("Aeropuerto de destino encontrado: {$destinoAirport->name}");

    // Consultar los vuelos disponibles desde la ciudad de origen hasta el destino
    $vuelos = DB::table('flights')
        ->join('airports as origin', 'flights.origin_airport_id', '=', 'origin.id')
        ->join('airports as destination', 'flights.destination_airport_id', '=', 'destination.id')
        ->where('origin.city_id', $origenAirport->city_id)  // Usamos el city_id de origen
        ->where('destination.city_id', $destinoAirport->city_id)  // Usamos el city_id de destino
        ->get();

    // Verificar los vuelos encontrados
    Log::info("Vuelos encontrados desde {$origenAirport->name} hacia {$destinoAirport->name}: " . $vuelos->count());

    // Retornar la vista con los detalles del destino y los vuelos
    return view('popular-destinations.show', compact('destino', 'vuelos'));
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
