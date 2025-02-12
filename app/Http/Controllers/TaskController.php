<?php

namespace App\Http\Controllers;

use App\Http\Requests\TaskRequest;
use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;


class TaskController extends Controller
{
    public function __construct()
    {
        $this->middleware("auth");
    }
    public function index()
    {
        $tasks = Task::where('user_id', Auth::id())->get();
        return view('home', compact('tasks'));
    }
    public function store(TaskRequest $request)
    {
     
        $task = Task::create([
            'name' => $request->name,
            'is_done' => false,
            'user_id' => Auth::id(),
        ]);
        return redirect()->route('home');
    }
    public function toggle(Task $task) 
    {
        if ($task->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $task->is_done = !$task->is_done;
        $task ->save();
        return redirect()->route('home');
    }
    public function update(TaskRequest $request, Task $task) 
    {
        if ($task->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }
        
        $task->name = $request->name;
        $task->save();
        return redirect()->route('home');
    }
    public function destroy(Task $task) 
    {
        if ($task->user_id !== Auth::id()) {
            abort(403, 'Unauthorized action.');
        }

        $task->delete();
        return redirect()->route('home');
    }   

}
