<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use App\Models\Flight;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index()
    {
        // Muestra todas las ofertas
        $offers = Offer::all();
        return view('offers.index', compact('offers'));
    }

    public function show($id)
    {
        // Muestra los detalles de una oferta
        $offer = Offer::findOrFail($id);
        return view('offers.show', compact('offer'));
    }

    public function create()
    {
        // Muestra el formulario para crear una nueva oferta
        $flights = Flight::all();  // Lista de vuelos disponibles
        return view('offers.create', compact('flights'));
    }

    public function store(Request $request)
    {
        // Guarda la nueva oferta
        $request->validate([
            'flight_id' => 'required|exists:flights,id',
            'discount' => 'required|numeric|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
        ]);

        Offer::create($request->all());
        return redirect()->route('offers.index');
    }

    public function edit($id)
    {
        // Muestra el formulario para editar una oferta
        $offer = Offer::findOrFail($id);
        $flights = Flight::all(); // Lista de vuelos disponibles
        return view('offers.edit', compact('offer', 'flights'));
    }

    public function update(Request $request, $id)
    {
        // Actualiza los datos de la oferta
        $request->validate([
            'flight_id' => 'required|exists:flights,id',
            'discount_percentage' => 'required|numeric|min:0|max:100',
            'start_date' => 'required|date',
            'end_date' => 'required|date|after:start_date',
            'offer_description' => 'nullable|string|max:255',
        ]);

        $offer = Offer::findOrFail($id);
        $offer->update($request->all());
        return redirect()->route('offers.index');
    }

    public function destroy($id)
    {
        // Elimina una oferta
        Offer::findOrFail($id)->delete();
        return redirect()->route('offers.index');
    }
}
