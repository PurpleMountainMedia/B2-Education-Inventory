<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Room;

class RoomsController extends Controller
{
    /**
     * View all rooms
     *
     * @var Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        return view('app.rooms.index');
    }

    /**
     * Display a specific room
     *
     * @var Request $request
     * @var App\Room $room
     * @return Response
     */
    public function show(Request $request, Room $room)
    {
        return view('app.rooms.show', compact('room'));
    }
}
