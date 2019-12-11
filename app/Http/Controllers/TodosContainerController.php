<?php

namespace App\Http\Controllers;

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
     * @param  \App\Todos_container  $todos_container
     * @return \Illuminate\Http\Response
     */
    public function show(Todos_container $todos_container)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Todos_container  $todos_container
     * @return \Illuminate\Http\Response
     */
    public function edit(Todos_container $todos_container)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Todos_container  $todos_container
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Todos_container $todos_container)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Todos_container  $todos_container
     * @return \Illuminate\Http\Response
     */
    public function destroy(Todos_container $todos_container)
    {
        //
    }
}
