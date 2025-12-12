<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    /**
     * Listar todas las tareas (GET /api/tasks)
     */
    public function index()
    {
        return Task::all();
    }

    /**
     * Crear una nueva tarea (POST /api/tasks)
     */
    public function store(Request $request)
    {
        // 1. Validamos que envíen los datos necesarios
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        // 2. Creamos la tarea en la base de datos
        $task = Task::create($request->all());

        // 3. Devolvemos la tarea creada con código 201 (Created)
        return response()->json($task, 201);
    }

    /**
     * Mostrar una tarea específica (GET /api/tasks/{id})
     */
    public function show(Task $task)
    {
        return $task;
    }

    /**
     * Actualizar una tarea (PUT/PATCH /api/tasks/{id})
     */
    public function update(Request $request, Task $task)
    {
        // 1. Validamos
        $request->validate([
            'title' => 'required',
            'description' => 'required',
        ]);

        // 2. Actualizamos
        $task->update($request->all());

        // 3. Devolvemos la tarea actualizada
        return $task;
    }

    /**
     * Eliminar una tarea (DELETE /api/tasks/{id})
     */
    public function destroy(Task $task)
    {
        $task->delete();
        return response()->json(null, 204); // 204 = No Content
    }
}