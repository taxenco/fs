<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TaskController; 
use Illuminate\Support\Facades\Route;

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
Route::get('/', [\App\Http\Controllers\TaskController::class, 'index'])->name('task.index');

Route::get('/create-task', [\App\Http\Controllers\TaskController::class, 'create'])->name('task.create');

Route::get('/edit-task/{id}', [\App\Http\Controllers\TaskController::class, 'edit'])->name('task.edit');

Route::delete('/delete-task/{id}', [\App\Http\Controllers\TaskController::class, 'delete'])->name('task.delete');










