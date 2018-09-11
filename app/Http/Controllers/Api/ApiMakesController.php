<?php

namespace App\Http\Controllers\Api;

use App\Make;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Make as MakeResource;

class ApiMakesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return MakeResource::collection(
            Make::withCount($request->withCount ?: [])
                        ->with($request->with ?: [])
                        ->filterable()
                        ->basicResponse()
        );
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
     * @param  \App\Make  $make
     * @return \Illuminate\Http\Response
     */
    public function show(Make $make)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Make  $make
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Make $make)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Make  $make
     * @return \Illuminate\Http\Response
     */
    public function destroy(Make $make)
    {
        //
    }
}
