<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WebController extends Controller
{
    /**
     * Show the homepage
     *
     */
    public function home()
    {
        return view('web.home');
    }
}
