<?php

namespace App\Http\Controllers;

use App\Models\Seat;
use App\Models\Airplane;
use Illuminate\Http\Request;

class SeatController extends Controller
{
    /**
     * Mostrar todos los asientos.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Obtener todos los asientos
        $seats = Seat::all();
        return view('seats.index', compact('seats'));
    }

    /**
     * Mostrar los detalles de un asiento.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Obtener un asiento específico
        $seat = Seat::findOrFail($id);
        return view('seats.show', compact('seat'));
    }

    /**
     * Mostrar el formulario para crear un asiento.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // Obtener los aviones disponibles
        $airplanes = Airplane::all();
        return view('seats.create', compact('airplanes'));
    }

    /**
     * Almacenar un nuevo asiento.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // Validar los datos del asiento
        $request->validate([
            'airplane_id' => 'required|exists:airplanes,id', // El avión debe existir
            'seat_number' => 'required|string|max:10',
            'seat_type' => 'required|in:economy,business,first', // Validación del tipo de asiento
            'status' => 'required|in:available,reserved,unavailable', // Validación del estado
        ]);

        // Crear el nuevo asiento
        Seat::create($request->all());

        return redirect()->route('seats.index');
    }

    /**
     * Mostrar el formulario para editar un asiento.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        // Obtener el asiento y los aviones disponibles
        $seat = Seat::findOrFail($id);
        $airplanes = Airplane::all();
        return view('seats.edit', compact('seat', 'airplanes'));
    }

    /**
     * Actualizar un asiento específico.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        // Validar los datos del asiento
        $request->validate([
            'airplane_id' => 'required|exists:airplanes,id',
            'seat_number' => 'required|string|max:10',
            'seat_type' => 'required|in:economy,business,first',
            'status' => 'required|in:available,reserved,unavailable',
        ]);

        // Encontrar y actualizar el asiento
        $seat = Seat::findOrFail($id);
        $seat->update($request->all());

        return redirect()->route('seats.index');
    }

    /**
     * Eliminar un asiento específico.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        // Encontrar y eliminar el asiento
        Seat::findOrFail($id)->delete();

        return redirect()->route('seats.index');
    }
}
