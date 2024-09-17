<?php

namespace App\Http\Controllers;

use App\Models\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{
    /**
     * Store a newly created task in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
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

    /**
     * Remove the specified task from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
    
        return response()->json([
            'message' => 'Task deleted successfully.',
            'tasks' => Task::all() 
        ]);
    }

    /**
     * Update the specified task in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function edit(Request $request, $id)
    {
        // Validate incoming data
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'description' => 'nullable|string',
            'status' => 'required|in:NEW,DONE',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 422);
        }

        // Find the task by ID
        $task = Task::find($id);

        if (!$task) {
            return response()->json(['message' => 'Task not found'], 404);
        }

        // Update the task with the validated data
        $task->title = $request->input('title');
        $task->description = $request->input('description');
        $task->status = $request->input('status');
        $task->save();

        return redirect('/')->with('success', 'Task updated successfully.');   
    }
}
