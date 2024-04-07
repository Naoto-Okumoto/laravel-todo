<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class TaskController extends Controller
{
    private $task;

    public function __construct(Task $task)
    {
        $this->task = $task;
    }

    public function index()
    {
        $home_tasks = $this->getHomeTasks();
        return view('tasks.index')->with('home_tasks', $home_tasks);
    }

    private function getHomeTasks()
    {
        $all_tasks = $this->task->latest()->get();
        $home_tasks = []; // 初期化
        foreach($all_tasks as $task)
        {
            if($task->user->id === Auth::user()->id)
            {
                $home_tasks[] = $task;
            }
        }
        return $home_tasks;
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|min:1|max:50'
        ]);
        $this->task->name = $request->name;
        $this->task->user_id = Auth::user()->id;
        $this->task->save();
        return redirect()->back();
    }

    public function edit($id)
    {
        $task = $this->task->findOrFail($id);
        return view('tasks.edit')->with('task', $task);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|min:1|max:50'
        ]);
        $task = $this->task->findOrFail($id);
        $task->name = $request->name;
        $task->save();
        return redirect()->route('index');
    }

    public function destroy($id)
    {
        $this->task->destroy($id);
        return redirect()->back();
    }
}
