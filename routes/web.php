<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TaskController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest')->group(function () {
Route::get("/login", [AuthController::class,"showLoginForm"])->name("login");
Route::post("/login", [AuthController::class,"login"]);

Route::get("/register", [AuthController::class,"showRegisterForm"])->name("register");
Route::post("/register", [AuthController::class,"register"]);
});

Route::post("/logout", [AuthController::class,"logout"])->name("logout");

Route::middleware('auth')->group(function () {
    Route::get('/', [TaskController::class,'index'])->name('home');
    Route::post('/tasks', [TaskController::class,'store'])->name('tasks.store');
    Route::patch('/tasks/{task}/toggle', [TaskController::class,'toggle'])->name('tasks.toggle');
    Route::put('/tasks/{task}', [TaskController::class,'update'])->name('tasks.update');
    Route::delete('/tasks/{task}', [TaskController::class, 'destroy'])->name('tasks.destroy');
});