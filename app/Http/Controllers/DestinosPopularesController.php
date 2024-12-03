<?php

namespace App\Http\Controllers;

use App\Models\DestinosPopulares;
use Illuminate\Http\Request;

class DestinosPopularesController extends Controller
{
    public function index()
    {
        // Obtener todos los destinos populares
        $destinos = DestinosPopulares::all();

        // Verificar que los destinos se están pasando correctamente a la vista
        return view('welcome', compact('destinos'));
    }
}
