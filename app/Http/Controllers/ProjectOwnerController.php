<?php

namespace App\Http\Controllers;

use App\Project_Owner;
use Illuminate\Http\Request;

class ProjectOwnerController extends Controller
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
        //
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
        //
    }
}
