<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController; // Added import
use Illuminate\Support\Facades\Route;

// Replaced the closure route with the controller route
Route::get('/', [HomeController::class, 'index']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/enviar-cotizacion', [App\Http\Controllers\CotizacionController::class, 'enviar'])->name('cotizacion.enviar');

require __DIR__.'/auth.php';