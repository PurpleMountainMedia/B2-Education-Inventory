<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class RoomsController extends Controller
{
    public function __construct()
    {

    }

    /**
     * View all rooms
     *
     * @var Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $rooms = [];
        return view('app.rooms.index', compact('rooms'));
    }
}
