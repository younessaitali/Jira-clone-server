<?php

namespace App\Http\Controllers;

use App\Board;
use App\Events\createBoard;
use App\Events\removeBoard;
use App\Events\updateBoard;
use App\Project;
use Illuminate\Http\Request;
use App\Jira\Transformers\BoardTransformer;

class BoardController extends ApiResponseController
{


    protected $boardTransformer;


    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(BoardTransformer $boardTransformer)
    {
        $this->boardTransformer = $boardTransformer;
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
        $project = Project::findOrFail($this->validateRequest()['project_id']);

        $this->authorize('update', $project);


        $board =  Board::create($this->validateRequest());
        event((new createBoard($board)));
        // broadcast(new createBoard($board))->dontBroadcastToCurrentUser();

        return $this->respond([
            'success' => true,
            'board' => $board
        ]);
    }



    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Board $board)
    {
        $project = Project::findOrFail($board->project_id);
        $this->authorize('update', $project);

        $board->update($this->validateRequest());
        // dd($this->boardTransformer->transform($board));
        event(new updateBoard($this->boardTransformer->transform($board)));

        return $this->respond([
            'success' => true,
            'data' => $board
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Board  $board
     * @return \Illuminate\Http\Response
     */
    public function destroy(Board $board)
    {
        $project = Project::findOrFail($board->project_id);

        $this->authorize('update', $project);

        event(new removeBoard($board));

        $board->delete();


        return $this->respond([
            'success' => true,
        ]);
    }
    protected function validateRequest()
    {
        return request()->validate([
            'title' => 'required',
            'project_id' => 'required',
            'sort' => 'required'
        ]);
    }
}
