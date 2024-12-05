<?php

namespace App\Http\Controllers;

use App\Models\PopularDestination;
use App\Models\City;
use Illuminate\Http\Request;

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


    /**
     * Mostrar un destino popular específico.
     */
    public function show($city_id)
{
    // Buscar el destino popular por el city_id proporcionado
    $destino = PopularDestination::with('city')->where('city_id', $city_id)->firstOrFail();

    // Retornar la vista con los detalles del destino
    return view('popular-destinations.show', compact('destino'));
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
