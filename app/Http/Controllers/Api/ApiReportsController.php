<?php

namespace App\Http\Controllers\Api;

use App\Report;
use Auth;
use App\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Report as ReportResource;
use App\Services\ReportService;

class ApiReportsController extends Controller
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

        return ReportResource::collection(
            Report::inSchool($request->schoolId)
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
    public function store(Request $request, ReportService $reportService)
    {
        $this->validate($request, [
            'data.name' => 'required',
            'data.type' => 'required'
        ]);

        $report = Report::create([
            'name' => $request->input('data.name'),
            'type' => $request->input('data.type'),
            'template' => 'standard',
            'school_id' => $request->schoolId,
            'data' => $reportService->getDataFromQuery($request->input('data.type'), $request->reportQuery),
            'query' => $request->reportQuery,
            'created_by' => Auth::user()->id,
            'notifications' => true,
            'repeat_every' => $request->input('data.repeatEvery'),
            'repeat_every_unit' => 'Days'
        ]);

        return new ReportResource($report->load($request->with ?: []));
    }

    /**
     * Display the specified resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Report $report)
    {
        return new ReportResource($report->load($request->with ?: []));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        $this->validate($request, [
            'data.name' => 'required'
        ]);

        $report->update([
            'name' => $request->input('data.name')
        ]);

        return new ReportResource($report->load($request->with ?: []));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy(Report $report)
    {
        $report->delete();
    }
}
