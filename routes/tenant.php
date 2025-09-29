<?php

declare(strict_types=1);

use App\Http\Controllers\Tenancy\AreasProduccion\AreasProduccion;
use App\Http\Controllers\Tenancy\Categorias\CategoriasController;
use App\Http\Controllers\Tenancy\Empresa\EmpresaController;
use App\Http\Controllers\Tenancy\Impresora\ImpresorasController;
use App\Http\Controllers\Tenancy\Pisos\PisosController;
use App\Http\Controllers\Tenancy\Productos\ProductoController;
use Illuminate\Support\Facades\Route;
use Stancl\Tenancy\Middleware\InitializeTenancyByDomain;
use Stancl\Tenancy\Middleware\PreventAccessFromCentralDomains;

/*
|--------------------------------------------------------------------------
| Tenant Routes
|--------------------------------------------------------------------------
|
| Here you can register the tenant routes for your application.
| These routes are loaded by the TenantRouteServiceProvider.
|
| Feel free to customize them however you want. Good luck!
|
*/

Route::middleware([
    'web',
    InitializeTenancyByDomain::class,
    PreventAccessFromCentralDomains::class,
])->group(function () {
    Route::get('/', function () {
        return redirect()->route('login');
    });

    Route::middleware('auth')->group(function () {
        Route::get('/dashboard', function () { return view('tenancy.dashboard'); })->name('dashboard');
        Route::get('profile', function () { return view('tenancy.profile'); })->name('profile');
        Route::get('pisos', [PisosController::class, 'index'])->name('pisos.index');
        Route::get('impresoras', [ImpresorasController::class, 'index'])->name('impresoras.index');
        Route::get('empresa', [EmpresaController::class, 'index'])->name('empresa.index');
        Route::post('empresa/store', [EmpresaController::class, 'store'])->name('empresa.store');
        Route::get('areasproduccion', [AreasProduccion::class, 'index'])->name('areasproduccion.index');
        Route::get('categorias', [CategoriasController::class, 'index'])->name('categorias.index');
        Route::get('productos', [ProductoController::class, 'index'])->name('productos.index');
        Route::get('productos/create', [ProductoController::class, 'create'])->name('productos.create');
    });



    require __DIR__ . '/auth.php';
});
