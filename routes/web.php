<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReservaController;
use App\Http\Controllers\PopularDestinationController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\FlightController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\AirportController;

Route::get('/', action: [PopularDestinationController::class, 'index']);


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/admin/popular-destinations/create', [PopularDestinationController::class, 'create'])->name('popular-destinations.create');
Route::post('/admin/popular-destinations', [PopularDestinationController::class, 'store'])->name('popular-destinations.store');
Route::get('popular-destinations', [PopularDestinationController::class, 'indexAll'])->name('popular-destinations.indexAll');
Route::get('/popular-destinations/{city_id}', [PopularDestinationController::class, 'show'])->name('popular-destinations.show');
Route::get('/vuelos/{fecha}', [PopularDestinationController::class, 'mostrarVuelos']);
Route::get('/vuelo/{flight_id}', [FlightController::class, 'show'])->name('flight.show');
Route::get('/flight/confirmar-vuelo/{flight}/{plan}', [FlightController::class, 'confirmarVuelo'])->name('flight.confirmar-vuelo');
Route::get('/search-flights', [FlightController::class, 'search']);



Route::resource('users', UserController::class);
Route::resource('flights', FlightController::class);
Route::resource('tickets', TicketController::class);
Route::resource('airports', AirportController::class);

require __DIR__.'/auth.php';
