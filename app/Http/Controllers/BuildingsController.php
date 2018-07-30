<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BuildingsController extends Controller
{
    public function __construct()
    {

    }

    /**
     * View all buildings
     *
     * @var Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $buildings = [];
        return view('app.buildings.index', compact('buildings'));
    }
}
