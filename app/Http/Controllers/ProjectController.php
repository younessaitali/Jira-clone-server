<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\Project;
use App\Project_Owner;
use App\User;
use Illuminate\Http\Request;
use App\Jira\Transformers\ProjectTransformer;

class ProjectController extends ApiResponseController
{


    protected $user, $projectTransformer;

    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct(ProjectTransformer $projectTransformer)
    {
        $this->middleware('auth:api');
        $this->user = JWTAuth::parseToken()->authenticate();
        $this->projectTransformer = $projectTransformer;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // dd('it');
        $projects = $this->user->accessibleProjects();
        return $this->respond([
            'success' => true,
            'projects' => $this->projectTransformer->projectTransform($projects),
            // 'projects' => $projects,
        ]);
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
        return $this->respond([
            'success' => true,
            'data' => $project
        ]);
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


        return $this->respond([
            'success' => true,
            'data' => $this->projectTransformer->transform($project)
        ]);
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
        return $this->respond([
            'success' => true,
            'data' => $this->projectTransformer->transform($project)
        ]);
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
        return $this->respond([
            'success' => true,
            'data' => $this->projectTransformer->transform($project)
        ]);
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
