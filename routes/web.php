<?php

use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::get('/', [TaskController::class,'index'])->name('home');
Route::post('/tasks', [TaskController::class,'store'])->name('tasks.store');
Route::patch('/tasks/{task}/toggle', [TaskController::class,'toggle'])->name('tasks.toggle');
Route::put('/tasks/{task}', [TaskController::class,'update'])->name('tasks.update');
Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');