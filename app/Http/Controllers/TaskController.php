<?php

namespace App\Http\Controllers;

use App\Board;
use App\Events\createTask;
use App\Events\removeTask;
use App\Events\updateTask;
use App\Task;
use Illuminate\Http\Request;

class TaskController extends ApiResponseController
{


    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
    }




    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // dd($request);



        $board = Board::findOrFail($this->validateRequest()['board_id']);

        $project = $board->project;
        // dd($project, $board);

        $this->authorize('update', $project);

        $task = Task::create($this->validateRequest());
        event(new createTask($task));


        return $this->respond([
            'success' => true,
            'task' => $task
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function show(Task $task)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Task $task)
    {
        $board = Board::findOrFail($task->board_id);
        $project = $board->project;
        $oldBoard = $task->board;

        $this->authorize('update', $project);
        // dd($this->validateRequest());
        $task->update($this->validateRequest());
        event(new updateTask($task, $oldBoard));
        return $this->respond([
            'success' => true,
            'task' => $task
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Task  $task
     * @return \Illuminate\Http\Response
     */
    public function destroy(Task $task)
    {
        $board = Board::findOrFail($task->board_id);

        $project = $board->project;

        $this->authorize('update', $project);

        event(new removeTask($task));
        $task->delete();
        return $this->respond([
            'success' => true,
        ]);
    }


    protected function validateRequest()
    {
        return request()->validate([
            'title' => 'required',
            'description' => 'nullable',
            'board_id' => 'required',
            'sort' => 'required',
            'start_at' => 'nullable',
            'end_at' => 'nullable'
        ]);
    }
}
