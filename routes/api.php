<?php

use App\Http\Controllers\Api\RucDniController;
use App\Http\Controllers\Api\UbigeosController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::get('departamentos', [UbigeosController::class, 'departamentos']);
Route::get('provincias', [UbigeosController::class, 'provincias']);
Route::get('distritos', [UbigeosController::class, 'distritos']);
Route::get('ruc', [RucDniController::class, 'getRuc']);
Route::get('dni', [RucDniController::class, 'getDni']);
