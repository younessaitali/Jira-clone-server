<?php

namespace App\Http\Controllers;

use App\Board;
use App\Project;
use Illuminate\Http\Request;

class BoardController extends Controller
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
        $project = Project::findOrFail($this->validateRequest()['project_id']);

        $this->authorize('update', $project);

        $board =  Board::create($this->validateRequest());

        return response()->json([
            'success' => true,
            'data' => $board
        ], 200);
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
        return response()->json([
            'success' => true,
            'data' => $board
        ], 200);
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

        $board->delete();
    }
    protected function validateRequest()
    {
        return request()->validate([
            'title' => 'required',
            'project_id' => 'required'
        ]);
    }
}
