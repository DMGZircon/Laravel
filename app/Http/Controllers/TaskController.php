<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;


class TaskController extends Controller
{
    
    public function index()
    {
        $tasks = Task::all();
        return view('home', compact('tasks'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tasks'=> 'required|string|max:255',
        ]);

        Task::create([
            'name' => $request->tasks,
            'is_done' => false,
        ]);
        return redirect()->route('home');
    }
    public function toggle(Task $task) {
        $task->is_done = !$task->is_done;
        $task ->save();
        return redirect()->route('home');
    }
    public function update(Request $request, Task $task) {
        $request->validate(['name' => 'required|string|max:255']);
        $task->name = $request->name;
        $task->save();
        return redirect()->route('home');
        }
    public function destroy(Task $task) {
        $task->delete();
        return redirect()->route('home');
    }   

}
