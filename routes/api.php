<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FlightController;


Route::get('/airport/{airportId}/arrivals', [FlightController::class, 'getArrivals']);
Route::get('/airport/{airportId}/departures', [FlightController::class, 'getDepartures']);
Route::get('cities/{cityId}/flights', [FlightController::class, 'getFlightsByCity']);
