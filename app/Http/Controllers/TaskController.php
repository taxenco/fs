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
    
    public function createView()
    {
        // Return the view for creating a new task
        return inertia('TaskCreate');
    }

    public function store(Request $request)
    {
        // Validate the incoming request
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ]);
    
        // Log validated data for debugging
        \Log::info($validatedData);
    
        // Create the task
        $task = Task::create($validatedData);
    
        // Redirect to the home page ("/") with a success message
        return redirect('/')
            ->with('success', 'Task created successfully.');
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
