<?php

namespace App\Http\Controllers\Api;

use App\Building;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Building as BuildingResource;
use App\Http\Resources\Room as RoomResource;

class ApiBuildingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->validate($request, [
            'schoolId' => 'required'
        ]);

        $this->authorize('list', Building::class);

        return BuildingResource::collection(
            Building::inSchool($request->schoolId)
                    ->withCount($request->withCount ?: [])
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
     * @param  \App\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Building $building)
    {
        return new BuildingResource($building->load($request->with ?: []));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Building $building)
    {
        $building->update([
            'name' => $request->input('data.name'),
            'type' => $request->input('data.type')
        ]);

        return new BuildingResource($building->load($request->with ?: []));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Building  $building
     * @return \Illuminate\Http\Response
     */
    public function destroy(Building $building)
    {
        $building->delete();
    }

    public function rooms(Building $building, Request $request)
    {
        return RoomResource::collection(
            $building->rooms()
                     ->withCount($request->withCount ?: [])
                     ->with($request->with ?: [])
                     ->filterable()
                     ->basicResponse()
        );
    }
}
