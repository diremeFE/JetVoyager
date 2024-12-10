<?php

namespace App\Http\Controllers;

use App\Models\Flight;
use App\Models\City;
use Illuminate\Http\Request;

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
        // Obtener el vuelo con sus relaciones, si es necesario
        $flight = Flight::with(['originAirport', 'destinationAirport'])->findOrFail($flight_id);

        // Pasar los datos a la vista
        return view('flight.show', compact('flight'));
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
