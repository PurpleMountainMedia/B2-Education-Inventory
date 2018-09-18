<?php

namespace App\Http\Controllers\Api;

use App\Item;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\Item as ItemResource;
use App\Http\Resources\GroupedItem as GroupedItemResource;
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

        $this->validate($request, [
            'schoolId' => 'required'
        ]);

        return ItemResource::collection(
            Item::inSchool($this->schoolId)
                ->inRoom($request->roomId)
                ->withCount($request->withCount ?: [])
                ->with($request->with ?: [])
                ->filterable()
                ->basicResponse()
        );
    }

    public function indexGrouped(Request $request)
    {
        return GroupedItemResource::collection(
            Item::inSchoolGrouped($request->schoolId)
                ->basicResponse('items.name')
        );
    }

    public function group(Request $request)
    {
        $this->validate($request, [
            'categoryId' => 'required',
            'roomId' => 'required',
            'itemName' => 'required',
            'schoolId' => 'required'
        ]);

        return ItemResource::collection(
            Item::inSchool($this->schoolId)
                ->inRoom($request->roomId)
                ->where('items.item_category_id', $request->categoryId)
                ->where('items.name', $request->itemName)
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
        $this->validate($request, [
            'name' => 'required'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Item  $item
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Item $item)
    {
        return new ItemResource($item->load($request->with ?: []));
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
        $this->validate($request, [
            'data.name' => 'required'
        ]);

        $item->update([
            'name' => $request->input('data.name'),
            'description' => $request->input('data.description'),
            'serial' => $request->input('data.serial'),
            'purchase_price' => $request->input('data.purchase_price'),
        ]);

        return new ItemResource($item->load($request->with ?: []));
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
            'schoolId' => 'required',
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
