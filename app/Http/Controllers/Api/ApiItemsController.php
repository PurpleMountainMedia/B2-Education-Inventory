<?php

namespace App\Http\Controllers\Api;

use App\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Item as ItemResource;
use App\Services\BuildingService;
use App\Services\ItemCategoryService;
use App\Services\RoomService;
use App\Services\MakeService;
use App\Services\ItemService;

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
                ->inRoom($request->roomId)
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

    public function bulkAdd(
        Request $request,
        BuildingService $buildingService,
        RoomService $roomService,
        ItemCategoryService $categoryService,
        MakeService $makeService,
        ItemService $itemService
    ) {


        $this->validate($request, [
            'items' => 'required|array',
            'items.*.room' => 'required',
            'items.*.building' => 'required',
            'items.*.name' => 'required',
        ]);

        $items = collect($request->items);

        $items = $buildingService->buildingsFromNames($this->schoolId, $items)
                                 ->mapTo($items, 'building')
                                 ->get();

        $items = $roomService->roomsFromNames($items)
                             ->mapTo($items, 'room')
                             ->get();

        $items = $categoryService->categoriesFromNames($items)
                                 ->mapTo($items, 'itemCategory')
                                 ->get();

        $items = $makeService->makesFromNames($this->schoolId, $items)
                             ->mapTo($items, 'make')
                             ->get();

        $items = $itemService->createItemsFromMultiple($items)
                             ->get();

        dd($items);
    }
}
