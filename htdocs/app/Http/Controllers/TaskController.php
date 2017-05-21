<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\TaskRepository;
use App\Task;

class TaskController extends Controller
{
    protected $tasks;

    public function __construct(TaskRepository $task)
    {
    	$this->middleware('auth');
    	$this->tasks = $task;
    }

    /**
     * @param Request $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(Request $request)
    {
    	return view('tasks.index', [
    	    //'tasks' => Task::where('user_id', $request->user()->id()->get()),
            'tasks' => $this->tasks->getUserTask($request->user())
        ]);
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
    	$this->validate($request, [
    		'name' => 'required|max:255'
    	]);

    	$request->user()->tasks()->create([
    	    'name' => $request->name
        ]);

    	return redirect('/tasks');
    }

    /**
     * @param Request $request
     * @param Task $task
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Request $request, Task $task)
    {
    	$this->authorize('destroy', $task);

    	$task->delete();

    	return redirect('/tasks');
    }
}
