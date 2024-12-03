<?php

namespace App\Http\Controllers;

use App\Models\Airplane;
use Illuminate\Http\Request;

class AirplaneController extends Controller
{
    /**
     * Mostrar todos los aviones.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $airplanes = Airplane::all();
        return response()->json($airplanes);
    }

    /**
     * Mostrar un avión específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $airplane = Airplane::findOrFail($id);
        return response()->json($airplane);
    }

    /**
     * Crear un nuevo avión.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'num_rows' => 'required|integer',
            'seats_per_row' => 'required|integer',
            'total_seats' => 'required|integer',
        ]);

        $airplane = Airplane::create($request->all());

        return response()->json($airplane, 201);
    }

    /**
     * Actualizar un avión específico.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $airplane = Airplane::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'num_rows' => 'required|integer',
            'seats_per_row' => 'required|integer',
            'total_seats' => 'required|integer',
        ]);

        $airplane->update($request->all());

        return response()->json($airplane);
    }

    /**
     * Eliminar un avión específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $airplane = Airplane::findOrFail($id);
        $airplane->delete();

        return response()->json(['message' => 'Airplane deleted successfully']);
    }
}
