<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController; 



// Esta ÚNICA línea crea las 5 rutas del CRUD automáticamente
Route::apiResource('users', UserController::class);

// Ruta extra solo para probar si la API responde (opcional)
Route::get('/status', function () {
    return response()->json(['message' => 'API Online y funcionando 🚀']);
});