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
use App\Http\Controllers\PrensaController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\ColaboradorController;


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
    Route::get('admin/nosotros', [App\Http\Controllers\Admin\NosotrosController::class, 'index'])->name('admin.nosotros');
    Route::post('admin/nosotros', [App\Http\Controllers\Admin\NosotrosController::class, 'store'])->name('admin.nosotros.store');




    // Servicios - Administración
    Route::prefix('admin')->name('admin.')->group(function () {
        // Listado y gestión de servicios
        Route::get('servicios', [ServicioController::class, 'adminIndex'])->name('servicios.index');
        Route::post('servicios', [ServicioController::class, 'store'])->name('servicios.store');
        Route::get('servicios/{servicio}/editar', [ServicioController::class, 'edit'])->name('servicios.edit');
        Route::put('servicios/{servicio}', [ServicioController::class, 'update'])->name('servicios.update');
        Route::delete('servicios/{servicio}', [ServicioController::class, 'destroy'])->name('servicios.destroy');
        Route::post('servicios/reordenar', [ServicioController::class, 'reorder'])->name('servicios.reorder');
        Route::post('servicios/contenido', [ServicioController::class, 'serviciospage'])->name('servicios_page.store');

        // Rutas para gestionar tags
        Route::get('tags', [TagController::class, 'index'])->name('tags.index');
        Route::post('tags', [TagController::class, 'store'])->name('tags.store');
        Route::put('tags/{tag}', [TagController::class, 'update'])->name('tags.update');
        Route::delete('tags/{tag}', [TagController::class, 'destroy'])->name('tags.destroy');

        // Gestión de noticias de prensa
        Route::get('prensa', [PrensaController::class, 'index'])->name('prensa.index');
        Route::post('prensa', [PrensaController::class, 'store'])->name('prensa.store');
        Route::get('prensa/{id}/edit', [PrensaController::class, 'edit'])->name('prensa.edit');
        Route::put('prensa/{id}', [PrensaController::class, 'update'])->name('prensa.update');
        Route::delete('prensa/{id}', [PrensaController::class, 'destroy'])->name('prensa.destroy');
        Route::get('prensa/categorias/by-name', [PrensaController::class, 'getCategoriaByName'])
            ->name('prensa.categorias.by-name');

        // Tu ruta existente
        Route::get('prensa/categorias/{id}/subtipos', [PrensaController::class, 'getSubtipos'])
            ->name('prensa.categorias.subtipos');

        // Configuración de textos
        Route::get('prensa/configuracion', [PrensaController::class, 'configuracion'])->name('prensa.configuracion');
        Route::post('prensa/configuracion', [PrensaController::class, 'saveConfiguracion'])->name('prensa.configuracion.save');
        Route::post('prensa/configuracion/seo', [PrensaController::class, 'saveSeoConfiguracion'])->name('prensa.configuracion.seo.save');

        // Gestión de categorías y subtipos
        Route::get('prensa/categorias', [PrensaController::class, 'categorias'])->name('prensa.categorias');
        Route::post('prensa/categorias', [PrensaController::class, 'storeCategoria'])->name('prensa.categorias.store');
        Route::get('prensa/categorias/{id}/edit', [PrensaController::class, 'editCategoria'])->name('prensa.categorias.edit');
        Route::put('prensa/categorias/{id}', [PrensaController::class, 'updateCategoria'])->name('prensa.categorias.update');
        Route::delete('prensa/categorias/{id}', [PrensaController::class, 'destroyCategoria'])->name('prensa.categorias.destroy');

        Route::post('prensa/subtipos', [PrensaController::class, 'storeSubtipo'])->name('prensa.subtipos.store');
        Route::get('prensa/subtipos/{id}/edit', [PrensaController::class, 'editSubtipo'])->name('prensa.subtipos.edit');
        Route::put('prensa/subtipos/{id}', [PrensaController::class, 'updateSubtipo'])->name('prensa.subtipos.update');
        Route::delete('prensa/subtipos/{id}', [PrensaController::class, 'destroySubtipo'])->name('prensa.subtipos.destroy');

        // Caracteristicas de servicios
        Route::get('servicios/{servicio}/caracteristicas', [ServicioController::class, 'caracteristicas'])->name('servicios.caracteristicas');
        Route::post('caracteristicas', [ServicioController::class, 'storeCaracteristica'])->name('caracteristicas.store');
        Route::get('caracteristicas/{caracteristica}/editar', [ServicioController::class, 'editCaracteristica'])->name('caracteristicas.edit');
        Route::put('caracteristicas/{caracteristica}', [ServicioController::class, 'updateCaracteristica'])->name('caracteristicas.update');
        Route::delete('caracteristicas/{caracteristica}', [ServicioController::class, 'destroyCaracteristica'])->name('caracteristicas.destroy');
        Route::post('servicios/{servicio}/caracteristicas/reordenar', [ServicioController::class, 'reorderCaracteristicas'])->name('caracteristicas.reorder');

        // Noticias - Administración
        Route::get('noticias', [NoticiasController::class, 'adminIndex'])->name('noticias.index');
        Route::get('noticias/crear', [NoticiasController::class, 'adminCreate'])->name('noticias.create');
        Route::post('noticias', [NoticiasController::class, 'adminStore'])->name('noticias.store');
        Route::get('noticias/{noticia}/editar', [NoticiasController::class, 'adminEdit'])->name('noticias.edit');
        Route::put('noticias/{noticia}', [NoticiasController::class, 'adminUpdate'])->name('noticias.update');
        Route::delete('noticias/{noticia}', [NoticiasController::class, 'adminDestroy'])->name('noticias.destroy');

        // Categorías de noticias
        Route::get('categorias', [CategoriaController::class, 'adminIndex'])->name('categorias.index');
        Route::get('categorias/crear', [CategoriaController::class, 'adminCreate'])->name('categorias.create');
        Route::post('categorias', [CategoriaController::class, 'adminStore'])->name('categorias.store');
        Route::get('categorias/{categoria}/editar', [CategoriaController::class, 'adminEdit'])->name('categorias.edit');
        Route::put('categorias/{categoria}', [CategoriaController::class, 'adminUpdate'])->name('categorias.update');
        Route::delete('categorias/{categoria}', [CategoriaController::class, 'adminDestroy'])->name('categorias.destroy');

        // Vista específica para categorías de noticias
        Route::get('noticias/categorias', [CategoriaController::class, 'adminIndex'])->name('noticias.categorias');

        // Configuración de noticias
        Route::get('configuracion-noticias', [ConfiguracionController::class, 'adminEdit'])->name('configuracion-noticias.edit');
        Route::put('configuracion-noticias', [ConfiguracionController::class, 'adminUpdate'])->name('configuracion-noticias.update');

        
        Route::get('/contacto', [ContactoController::class, 'adminIndex'])->name('contacto.index');
        Route::put('/contacto/update', [ContactoController::class, 'adminUpdate'])->name('contacto.update');
        
        // Gestión de FAQs
        Route::post('/contacto/faqs', [ContactoController::class, 'adminFaqsStore'])->name('contacto.faqs.store');
        Route::put('/contacto/faqs/{id}', [ContactoController::class, 'adminFaqsUpdate'])->name('contacto.faqs.update');
        Route::delete('/contacto/faqs/{id}', [ContactoController::class, 'adminFaqsDestroy'])->name('contacto.faqs.destroy');
        Route::post('/contacto/faqs/update-order', [ContactoController::class, 'adminFaqsUpdateOrder'])->name('contacto.faqs.update-order');
        Route::resource('colaboradores', ColaboradorController::class)->names('colaboradores');


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

// Cambio aquí: usar salaPrensaPublica para la ruta pública en lugar de index
Route::get('/prensa', [PrensaController::class, 'salaPrensaPublica'])->name('prensa.index');
Route::get('prensa/pdf/{filename}', [App\Http\Controllers\PrensaController::class, 'descargarPdf'])->name('prensa.descargar.pdf');
Route::post('/prensa/suscribir', [PrensaController::class, 'suscribir'])->name('prensa.suscribir');

Route::get('/contacto', [ContactoController::class, 'index'])->name('contacto.index');

require __DIR__ . '/auth.php';
