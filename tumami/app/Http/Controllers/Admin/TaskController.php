<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Task;
class TaskController extends Controller
{
    public function index(Request $request)
    {
        $tasks = Task::all();
        return view('admin/tasks/index', ['tasks' => $tasks]);
    }

    public function create(Request $request)
    {
        $this->validate($request, Task::$rules);
        $task = new Task;
        $task->title = $request->title;
        $user = \Auth::user();
        $task->user_id = $user->id;
        $task->save();

        return redirect('admin/tasks/index');
    }
    public function delete(Request $request)
    {
        $task = Task::find($request->id);
        $task->delete();
        return redirect('admin/tasks/index');
    }
}
