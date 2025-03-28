<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\HomeController; // Added import
use App\Http\Controllers\HomepageController; // Added import
use App\Http\Controllers\ServicioController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\NosotrosController;
use App\Http\Controllers\NoticiasController;
use App\Http\Controllers\ConfiguracionController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\CotizacionController;
use App\Http\Controllers\TagController;

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
        Route::post('/servicios/contenido', [ServicioController::class, 'serviciospage'])->name('servicios_page.store');

        // Rutas para gestionar tags
        Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
        Route::post('/tags', [TagController::class, 'store'])->name('tags.store');
        Route::put('/tags/{tag}', [TagController::class, 'update'])->name('tags.update');
        Route::delete('/tags/{tag}', [TagController::class, 'destroy'])->name('tags.destroy');

        // Caracteristicas de servicios
        Route::get('/servicios/{servicio}/caracteristicas', [ServicioController::class, 'caracteristicas'])->name('servicios.caracteristicas');
        Route::post('/caracteristicas', [ServicioController::class, 'storeCaracteristica'])->name('caracteristicas.store');
        Route::get('/caracteristicas/{caracteristica}/editar', [ServicioController::class, 'editCaracteristica'])->name('caracteristicas.edit');
        Route::put('/caracteristicas/{caracteristica}', [ServicioController::class, 'updateCaracteristica'])->name('caracteristicas.update');
        Route::delete('/caracteristicas/{caracteristica}', [ServicioController::class, 'destroyCaracteristica'])->name('caracteristicas.destroy');
        Route::post('/servicios/{servicio}/caracteristicas/reordenar', [ServicioController::class, 'reorderCaracteristicas'])->name('caracteristicas.reorder');

        // Noticias - Administración
        Route::get('/noticias', [NoticiasController::class, 'adminIndex'])->name('noticias.index');
        Route::get('/noticias/crear', [NoticiasController::class, 'adminCreate'])->name('noticias.create');
        Route::post('/noticias', [NoticiasController::class, 'adminStore'])->name('noticias.store');
        Route::get('/noticias/{noticia}/editar', [NoticiasController::class, 'adminEdit'])->name('noticias.edit');
        Route::put('/noticias/{noticia}', [NoticiasController::class, 'adminUpdate'])->name('noticias.update');
        Route::delete('/noticias/{noticia}', [NoticiasController::class, 'adminDestroy'])->name('noticias.destroy');

        // Categorías de noticias
        Route::get('/categorias', [CategoriaController::class, 'adminIndex'])->name('categorias.index');
        Route::get('/categorias/crear', [CategoriaController::class, 'adminCreate'])->name('categorias.create');
        Route::post('/categorias', [CategoriaController::class, 'adminStore'])->name('categorias.store');
        Route::get('/categorias/{categoria}/editar', [CategoriaController::class, 'adminEdit'])->name('categorias.edit');
        Route::put('/categorias/{categoria}', [CategoriaController::class, 'adminUpdate'])->name('categorias.update');
        Route::delete('/categorias/{categoria}', [CategoriaController::class, 'adminDestroy'])->name('categorias.destroy');

        // Vista específica para categorías de noticias
        Route::get('/noticias/categorias', [CategoriaController::class, 'adminIndex'])->name('noticias.categorias');

        // Configuración de noticias
        Route::get('/configuracion-noticias', [ConfiguracionController::class, 'adminEdit'])->name('configuracion-noticias.edit');
        Route::put('/configuracion-noticias', [ConfiguracionController::class, 'adminUpdate'])->name('configuracion-noticias.update');
    });
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::post('/enviar-cotizacion', [CotizacionController::class, 'enviar'])->name('cotizacion.enviar');

Route::get('/servicios', [ServicioController::class, 'index'])->name('servicios');
Route::get('/nosotros', [NosotrosController::class, 'index'])->name('nosotros');

Route::get('/noticias', [NoticiasController::class, 'index'])->name('noticias.index');
Route::get('/noticias/{slug}', [NoticiasController::class, 'show'])->name('noticias.show');


require __DIR__ . '/auth.php';
