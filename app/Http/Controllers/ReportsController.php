<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReportsController extends Controller
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
        $reports = [];
        return view('app.reports.index', compact('reports'));
    }
}
