<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index(Request $request)
    {
        $tasks = Task::query();
        $query = Task::query();

        if ($request->has('status')) {
            $query->where('status', $request->status);
        }
    
        return response()->json($query->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:pending,in_progress,completed',
        ]);

        $task = Task::create($request->validated());
        return response()->json($task, 201);
    }

    public function show($id)
    {
        $task = Task::findOrFail($id);
        return response()->json($task);
    }

    public function update(Request $request, $id)
    {
        // Encontre a tarefa pelo ID
        $task = Task::find($id);

        // Se não encontrar a tarefa, retorna erro 404
        if (!$task) {
            return response()->json(['error' => 'Task not found'], 404);
        }

        // Atualize a tarefa com os dados validados
        $task->update($request->validated());

        // Retorne a tarefa atualizada
        return response()->json($task);
    
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return response()->json(null, 204);
    }
}