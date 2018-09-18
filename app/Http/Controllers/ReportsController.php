<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Report;

class ReportsController extends Controller
{
    public function __construct()
    {
        //
    }

    /**
     * View all reports
     *
     * @var Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        return view('app.reports.index', compact('reports'));
    }

    /**
     * Show specific report
     *
     * @var Request $request
     * @var App\Report $report
     * @return Response
     */
    public function show(Request $request, Report $report)
    {
        return view('app.reports.show', compact('report'));
    }

    /**
     * Print a specific report
     *
     * @var Request $request
     * @var App\Report $report
     * @return Response
     */
    public function print(Request $request, Report $report)
    {
        return view('app.reports.print', compact('report'));
    }
}
