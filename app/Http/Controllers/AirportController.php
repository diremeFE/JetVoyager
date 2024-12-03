<?php

namespace App\Http\Controllers;

use App\Models\Airport;
use Illuminate\Http\Request;

class AirportController extends Controller
{
    /**
     * Mostrar todos los aeropuertos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $airports = Airport::all(); // Devuelve todos los aeropuertos
        return response()->json($airports);
    }

    /**
     * Mostrar un aeropuerto específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $airport = Airport::findOrFail($id); // Devuelve un aeropuerto específico
        return response()->json($airport);
    }

    /**
     * Crear un nuevo aeropuerto.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'code_iata' => 'required|string|max:3|unique:airports',
            'name' => 'required|string|max:255',
            'city_id' => 'required|integer|exists:cities,id', // Validación para asegurarse que la ciudad existe
        ]);

        $airport = Airport::create($request->all());

        return response()->json($airport, 201);
    }

    /**
     * Actualizar un aeropuerto específico.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $airport = Airport::findOrFail($id);

        $request->validate([
            'code_iata' => 'required|string|max:3|unique:airports,code_iata,' . $id,
            'name' => 'required|string|max:255',
            'city_id' => 'required|integer|exists:cities,id',
        ]);

        $airport->update($request->all());

        return response()->json($airport);
    }

    /**
     * Eliminar un aeropuerto específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $airport = Airport::findOrFail($id);
        $airport->delete();

        return response()->json(['message' => 'Airport deleted successfully']);
    }
}
