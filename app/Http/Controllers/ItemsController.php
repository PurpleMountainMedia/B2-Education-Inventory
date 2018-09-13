<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Item;

class ItemsController extends Controller
{
    /**
     * Show the view for indexing all items.
     *
     * @return Response
     */
    public function index()
    {
        return view('app.items.index');
    }

    /**
     * Display a specific item
     *
     * @var Request $request
     * @var App\Room $room
     * @return Response
     */
    public function show(Request $request, Item $item)
    {
        return view('app.items.show', compact('item'));
    }

    /**
     * Show the view for the item create table.
     *
     * @return Response
     */
    public function createTable()
    {
        return view('app.items.create-table');
    }
}
