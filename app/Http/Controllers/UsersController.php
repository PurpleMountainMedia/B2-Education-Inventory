<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UsersController extends Controller
{
    /**
     * View all rooms
     *
     * @var Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        return view('app.users.index');
    }

    /**
     * Display a specific room
     *
     * @var Request $request
     * @var App\Room $room
     * @return Response
     */
    public function show(Request $request, User $user)
    {
        return view('app.users.show', compact('user'));
    }
}
