<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController; 
use Illuminate\Support\Facades\Route;
use App\Models\Task;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/**
 * Display the task index page with all tasks.
 *
 * @return \Illuminate\View\View
 */
Route::get('/', fn() => inertia('TaskIndex', ['tasks' => Task::all()]))->name('task.index');

/**
 * Display the view for creating a new task.
 *
 * @return \Illuminate\View\View
 */
Route::get('/create-task-view', fn() => inertia('TaskCreate'))->name('task.create');

/**
 * Display the view for editing a specific task.
 *
 * @param int $id The ID of the task to edit.
 * @return \Illuminate\View\View
 */
Route::get('/edit-task-view/{id}', fn($id) => inertia('TaskEdit', ['task' => Task::findOrFail($id)]))->name('task.edit');

/**
 * Store a newly created task.
 *
 * @param \Illuminate\Http\Request $request The request containing task data.
 * @return \Illuminate\Http\Response
 */
Route::post('/create-task', [\App\Http\Controllers\TaskController::class, 'store']);

/**
 * Update the specified task.
 *
 * @param int $id The ID of the task to update.
 * @param \Illuminate\Http\Request $request The request containing updated task data.
 * @return \Illuminate\Http\Response
 */
Route::put('/edit-task/{id}', [\App\Http\Controllers\TaskController::class, 'edit']);

/**
 * Remove the specified task from admin tasks.
 *
 * @param int $id The ID of the task to delete.
 * @return \Illuminate\Http\Response
 */
Route::delete('/delete-task/{id}', [\App\Http\Controllers\TaskController::class, 'delete']);
