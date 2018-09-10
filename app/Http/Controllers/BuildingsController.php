<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Building;

class BuildingsController extends Controller
{
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

    /**
     * Display a specific building
     *
     * @var Request $request
     * @var App\Building $building
     * @return Response
     */
    public function show(Request $request, Building $building)
    {
        return $building;
    }
}
