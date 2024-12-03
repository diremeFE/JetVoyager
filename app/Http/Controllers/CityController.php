<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CityController extends Controller
{
    /**
     * Mostrar todas las ciudades.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Devuelve todas las ciudades
        return response()->json(City::all());
    }

    /**
     * Mostrar una ciudad específica.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Devuelve una ciudad específica
        return response()->json(City::findOrFail($id));
    }

    /**
     * Crear una nueva ciudad.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar los datos de entrada
        $request->validate([
            'name' => 'required|string|max:255',
            'country' => 'required|string|max:255',
        ]);

        // Crear una nueva ciudad
        $city = City::create($request->all());

        // Retornar la ciudad creada
        return response()->json($city, 201);
    }

    /**
     * Actualizar una ciudad específica.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Encontrar la ciudad
        $city = City::findOrFail($id);

        // Actualizar la ciudad con los nuevos datos
        $city->update($request->all());

        // Retornar la ciudad actualizada
        return response()->json($city);
    }

    /**
     * Eliminar una ciudad específica.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Encontrar la ciudad
        $city = City::findOrFail($id);

        // Eliminar la ciudad
        $city->delete();

        // Retornar un mensaje de éxito
        return response()->json(['message' => 'City deleted successfully']);
    }
}
