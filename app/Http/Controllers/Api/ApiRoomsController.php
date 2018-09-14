<?php

namespace App\Http\Controllers\Api;

use App\Room;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Room as RoomResource;

class ApiRoomsController extends Controller
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

        $this->authorize('list', Room::class);

        return RoomResource::collection(
            Room::inSchool($request->schoolId)
                ->inBuilding($request->buildingId)
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
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Room $room)
    {
        return new RoomResource($room->load($request->with ?: []));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Room $room)
    {
        $this->validate($request, [
            'data.name' => 'required',
        ]);

        $room->update([
            'name' => $request->input('data.name'),
        ]);

        return new RoomResource($room->load($request->with ?: []));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Room  $room
     * @return \Illuminate\Http\Response
     */
    public function destroy(Room $room)
    {
        //
    }
}
