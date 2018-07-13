<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
     * Show the view for the item create table.
     *
     * @return Response
     */
    public function createTable()
    {
        return view('app.items.create-table');
    }
}
