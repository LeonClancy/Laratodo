<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;
use App\Policies\TaskPolicy;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class TaskController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = auth()->user()->tasks()->incomplete()->get();

        return view('task.list')->with('tasks',$tasks);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = $this->taskValidator($request);

        if($validator->fails()) {
            return Redirect('task')
                ->withErrors($validator)
                ->withInput();
        }

        $task = new Task();

        $task->name = $request->name;
        $task->user_id = auth()->id();

        $task->save();
        return Redirect('task');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Task $task)
    {
        $this->authorize('edit', $task);

        return view('task/edit', [
            'task' => $task
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Task $task)
    {
        $this->authorize('update', $task);

        $validator = $this->taskValidator($request);

        if($validator->fails()) {
            return Redirect(route('task.edit', $task->id))
                ->withErrors($validator);
        }

        $task->name = $request->name;

        $task->save();

        return Redirect(route('task.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $this->authorize('delete',$task);

        $task->delete();

        return Redirect(route('task.index'));
    }

    /**
     *  Complete the specified task.
     *
     *  @param int $id
     *  @return \Illuminate\Http\Response
     */
    public function complete(Task $task)
    {
        $this->authorize('complete', $task);

        $task->complete = 1;

        $task->save();

        return Redirect(route('task.index'));
    }

    /**
     *  list completed tasks.
     *
     *  @return \Illuminate\Http\Response
     */
    public function completed()
    {
        $tasks = Task::where('user_id', auth()->id())
                    ->where('complete', 1)
                    ->get();

        return view('task.complete', [
            'tasks' => $tasks
        ]);
    }

    /**
     *  Resume completed task.
     *
     *  @return \illuminate\Http\Response
     */
    public function resume(Task $task)
    {
        $this->authorize('resume', $task);

        $task->complete = 0;
        $task->save();

        return Redirect(route('task.completed'));
    }

    /**
     *  輸入驗證
     *
     *  @return \illuminate\Http\Response
     */
    private function taskValidator($request)
    {
        return Validator::make($request->all(),[
            'name' => 'required|min:2'
        ]);
    }
}
