<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Task;
class TaskController extends Controller
{
    public function index(Request $request)
    {
        $user = \Auth::user();
        $user_id = $user->id;
        $tasks = Task::where('user_id', $user_id)->get();
        return view('admin/tasks/index', ['tasks' => $tasks, 'user_id' => $user_id]);
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
