<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
{
    public function index()
    {
        // Fetch all tasks from the database
        $tasks = Task::all();
    
        // Return the view with the tasks data
        return inertia('TaskIndex', ['tasks' => $tasks]);
    }
    
    public function create()
    {
        // Return the view for creating a new task
        return inertia('TaskCreate');
    }

    public function edit($task)
    {
        // Return the view for editing an existing task with the task data
        return inertia('TaskEdit');
    }

    public function delete($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
    
        return response()->json([
            'message' => 'Task deleted successfully.',
            'tasks' => Task::all() // Assuming you want to return all tasks after deletion
        ]);
    }
    
}
