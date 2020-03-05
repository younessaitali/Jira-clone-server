<?php

namespace App\Http\Controllers;

use App\Project;
use App\Project_Owner;
use Illuminate\Http\Request;

class ProjectOwnerController extends ApiResponseController
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        // dd($request->owner_id);
        $project = Project::where('id', $request->project_id)->first();
        $this->authorize('update', $project);

        $exists = Project_Owner::where([
            ['owner_id', '=', $request->owner_id],
            ['project_id', '=', $request->project_id]
        ])->exists();
        if ($exists) {
            return $this->respond([
                'success' => false,
                'message' => 'already a member'
            ]);
        }
        $newOwner = Project_Owner::create($this->validateRequest());
        return $this->respond([
            'success' => true,
            'user' => $newOwner
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project_Owner  $project_Owner
     * @return \Illuminate\Http\Response
     */
    public function show(Project_Owner  $project_Owner)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project_Owner  $Project_Owner
     * @return \Illuminate\Http\Response
     */
    public function edit(Project_Owner $project_Owner)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project_Owner  $project_Owner
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project_Owner $project_Owner)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project_Owner  $project_Owner
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project_Owner $project_Owner)
    {
        // dd($project_Owner);
        $project = Project::findOrFail($project_Owner->project_id);
        // dd($project);

        $this->authorize('update', $project);
        $project_Owner->delete();
    }

    protected function validateRequest()
    {
        return request()->validate([
            'owner_id' => 'required',
            'project_id' => 'required',
        ]);
    }
}
