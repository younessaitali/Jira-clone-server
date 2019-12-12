<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\Project;
use App\Project_Owner;
use App\User;
use Illuminate\Http\Request;


class ProjectController extends Controller
{


    protected $user;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api');
        $this->user = JWTAuth::parseToken()->authenticate();
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $project = $this->user->accessibleProjects();
        return $project;
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
        $project = $this->user->projects()->create($this->validateRequest());

        $owner = new Project_Owner();
        $owner->project_id = $project->id;
        $owner->owner_id = $project->owner_id;
        $owner->save();
        return response()->json([
            'success' => true,
            'data' => $project
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $this->authorize('update', $project);

        return $project;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $this->authorize('update', $project);

        $project->update($this->validateRequest());
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $this->authorize('update', $project);

        $project->delete();
    }

    protected function validateRequest()
    {
        return request()->validate([
            'title' => 'required',
            'start_at' => 'nullable',
            'end_at' => 'nullable'
        ]);
    }
}
