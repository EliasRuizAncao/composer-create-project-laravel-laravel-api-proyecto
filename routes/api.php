<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TaskController; // <-- Importante: Importamos tu controlador

// Ruta por defecto de usuario (la dejamos por si acaso)
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::apiResource('tasks', TaskController::class);