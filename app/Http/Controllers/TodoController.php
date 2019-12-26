<?php

namespace App\Http\Controllers;

use App\Todo;
use App\Todos_container;
use Illuminate\Http\Request;

class TodoController extends ApiResponseController
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
        $this->authorization($this->validateRequest()['container_id']);

        $todo = Todo::create($this->validateRequest());

        return $this->respond([
            'success' => true,
            'todo' => $todo
        ]);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todo $todo)
    {
        $this->authorization($todo->container_id);
        // dd($this->validateRequest());
        $todo->update($this->validateRequest());

        return $this->respond([
            'success' => true,
            'data' => $todo
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todo  $todo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todo $todo)
    {
        $this->authorization($todo->container_id);
        $todo->delete();
        return $this->respond([
            'success' => true,
        ]);
    }

    protected function validateRequest()
    {
        return request()->validate([
            'title' => 'required',
            'container_id' => 'required',
        ]);
    }

    protected function authorization($id)
    {

        $todos = Todos_container::findOrFail($id);
        $task = $todos->task;
        $board = $task->board;
        $project = $board->project;

        $this->authorize('update', $project);
    }
}
