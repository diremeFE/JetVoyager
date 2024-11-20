<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Ruta para mostrar el perfil (ver detalles del perfil)
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile.show');
    
    // Ruta para editar el perfil
    Route::get('/profile/edit', [ProfileController::class, 'edit'])->name('profile.edit');
    
    // Ruta para actualizar el perfil
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    
    // Ruta para eliminar el perfil
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
