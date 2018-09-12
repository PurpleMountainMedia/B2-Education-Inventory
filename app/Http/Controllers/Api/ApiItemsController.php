<?php

namespace App\Http\Controllers\Api;

use App\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Item as ItemResource;
use App\Services\BuildingService;
use App\Services\RoomService;

class ApiItemsController extends Controller
{
    protected $schoolId;

    public function __construct(Request $request)
    {
        $this->validate($request, [
            'schoolId' => 'required'
        ]);
        $this->schoolId = $request->schoolId;
    }

    /**
     * Display a listing of the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $this->authorize('list', Item::class);

        return ItemResource::collection(
            Item::inSchool($this->schoolId)
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
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Item $item)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Item $item)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function destroy(Item $item)
    {
        //
    }

    public function bulkAdd(Request $request, BuildingService $buildingService, RoomService $roomService)
    {


        $this->validate($request, [
            'items' => 'required|array'
        ]);

        $items = collect($request->items);

        $buildings = $buildingService->buildingsFromNames(
            $this->schoolId,
            $items->pluck('building')->toArray()
        );

        $items = $items->map(function ($item) use ($buildings) {
            $item['building'] = $buildings->where(
                'name',
                'like',
                trim($item['building'])
            )->first();
            return $item;
        });

        $rooms = $roomService->roomsFromNames($items);

        $items = $items->map(function ($item) use ($rooms) {
            $item['room'] = $rooms->where(
                'name',
                'like',
                trim($item['room'])
            )->first();
            return $item;
        });

        dd($items);

        $item = [
            "barcodeStart" => 1,
            "barcodeEnd" => 1,
            "building" => "Test Building",
            "room" => "Test Room",
            "item_type" => null,
            "name" => "New Name",
            "description" => "New Description",
            "make" => "Apple",
            "serial" => "010101",
            "purchase_date" => null,
            "purchase_price" => null,
            "write_off" => null,
            "qty" => 1,
            "itemCategory" => "AV Equipment",
            "purchaseDate" => "11/09/2018",
            "purchasePrice" => "1000",
            "writeOff" => "10/09/2018"
        ];
    }
}
