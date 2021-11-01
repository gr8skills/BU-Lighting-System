<?php

namespace App\Http\Controllers\Admin;

use App\LightSystem;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class LightSystemController extends Controller
{

    public function index()
    {
        $allLights = LightSystem::all();
        return view('admin.users.index', compact('allLights'));
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
     * @param  \App\LightSystem  $lightSystem
     * @return \Illuminate\Http\Response
     */
    public function show(LightSystem $lightSystem)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\LightSystem  $lightSystem
     * @return \Illuminate\Http\Response
     */
    public function edit(LightSystem $lightSystem)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\LightSystem  $lightSystem
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, LightSystem $lightSystem)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\LightSystem  $lightSystem
     * @return \Illuminate\Http\Response
     */
    public function destroy(LightSystem $lightSystem)
    {
        //
    }
}
