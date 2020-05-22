<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Task;

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
    public function edit($id)
    {
        $task = Task::find($id);

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
    public function update(Request $request, $id)
    {
        $task = Task::find($id);
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
    public function destroy($id)
    {
        $task = Task::find($id);
        $task->delete();
        return Redirect(route('task.index'));
    }

    /**
     *  Complete the specified task.
     *
     *  @param int $id
     *  @return \Illuminate\Http\Response
     */
    public function complete($id)
    {
        $task = Task::find($id);
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
    public function resume($id)
    {
        $task = Task::find($id);
        $task->complete = 0;
        $task->save();
        return Redirect(route('task.completed'));
    }
}
