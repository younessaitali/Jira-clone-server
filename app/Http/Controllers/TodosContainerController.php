<?php

namespace App\Http\Controllers;

use App\Task;
use App\Todos_container;
use Illuminate\Http\Request;

class TodosContainerController extends Controller
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
        $this->authorization($this->validateRequest()['task_id']);
        $todo_container = Todos_container::create($this->validateRequest());
        return response()->json([
            'success' => true,
            'data' => $todo_container
        ], 200);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Todos_container  $todos_container
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todos_container $todosContainer)
    {
        $this->authorization($todosContainer->task_id);
        $todosContainer->update($this->validateRequest());
        return response()->json([
            'success' => true,
            'data' => $todosContainer
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todos_container  $todos_container
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todos_container $todosContainer)
    {
        $this->authorization($todosContainer->task_id);
        $todosContainer->delete();
    }



    protected function validateRequest()
    {
        return request()->validate([
            'title' => 'required',
            'task_id' => 'required',
        ]);
    }

    protected function authorization($id)
    {
        $task = Task::findOrFail($id);
        $board = $task->board;
        $project = $board->project;

        $this->authorize('update', $project);
    }
}
