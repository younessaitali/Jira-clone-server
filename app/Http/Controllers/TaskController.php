<?php

namespace App\Http\Controllers;

use App\Board;
use App\Task;
use Illuminate\Http\Request;

class TaskController extends Controller
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

        return response()->json([
            'success' => true,
            'data' => $task
        ], 200);
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

        $this->authorize('update', $project);
        // dd($this->validateRequest());
        $task->update($this->validateRequest());

        return response()->json([
            'success' => true,
            'data' => $task
        ], 200);
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

        $task->delete();
    }


    protected function validateRequest()
    {
        return request()->validate([
            'title' => 'required',
            'description' => 'required',
            'board_id' => 'required',
            'start_at' => 'nullable',
            'end_at' => 'nullable'
        ]);
    }
}
