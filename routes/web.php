<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController; // Added import
use App\Http\Controllers\HomepageController; // Added import
use App\Http\Controllers\ServicioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NosotrosController;

// Replaced the closure route with the controller route
Route::get('/', [HomeController::class, 'index']);

Route::get('/dashboard', function () {
    return redirect()->route('admin.homepage.index');
})->middleware(['auth', 'verified'])->name('dashboard');


// Rutas protegidas por autenticación
Route::middleware(['auth'])->group(function () {
    // Homepage
    Route::get('/admin/homepage', [HomepageController::class, 'index'])->name('admin.homepage.index');
    Route::put('/admin/homepage', [HomepageController::class, 'update'])->name('admin.homepage.update');
    
    // Servicios - Administración
    Route::prefix('admin')->name('admin.')->group(function () {
        // Listado y gestión de servicios
        Route::get('/servicios', [ServicioController::class, 'adminIndex'])->name('servicios.index');
        Route::post('/servicios', [ServicioController::class, 'store'])->name('servicios.store');
        Route::get('/servicios/{servicio}/editar', [ServicioController::class, 'edit'])->name('servicios.edit');
        Route::put('/servicios/{servicio}', [ServicioController::class, 'update'])->name('servicios.update');
        Route::delete('/servicios/{servicio}', [ServicioController::class, 'destroy'])->name('servicios.destroy');
        Route::post('/servicios/reordenar', [ServicioController::class, 'reorder'])->name('servicios.reorder');
        Route::post('/servicios/contenido', [\App\Http\Controllers\ServicioController::class, 'serviciospage'])->name('servicios_page.store');


        // Caracteristicas de servicios
        Route::get('/servicios/{servicio}/caracteristicas', [ServicioController::class, 'caracteristicas'])->name('servicios.caracteristicas');
        Route::post('/caracteristicas', [ServicioController::class, 'storeCaracteristica'])->name('caracteristicas.store');
        Route::get('/caracteristicas/{caracteristica}/editar', [ServicioController::class, 'editCaracteristica'])->name('caracteristicas.edit');
        Route::put('/caracteristicas/{caracteristica}', [ServicioController::class, 'updateCaracteristica'])->name('caracteristicas.update');
        Route::delete('/caracteristicas/{caracteristica}', [ServicioController::class, 'destroyCaracteristica'])->name('caracteristicas.destroy');
        Route::post('/servicios/{servicio}/caracteristicas/reordenar', [ServicioController::class, 'reorderCaracteristicas'])->name('caracteristicas.reorder');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/enviar-cotizacion', [App\Http\Controllers\CotizacionController::class, 'enviar'])->name('cotizacion.enviar');

Route::get('/servicios', [App\Http\Controllers\ServicioController::class, 'index'])->name('servicios');
Route::get('/nosotros', [NosotrosController::class, 'index'])->name('nosotros');


require __DIR__.'/auth.php';