<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SessionController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Change the session data of what school the user is viewing.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function change(Request $request)
    {
        $request->session()->put('school', $request->school);
        return $request->url() === route('choose-school') ? redirect(route('dashboard.index')) : redirect()->back();
    }

    public function choose(Request $request)
    {
        return view('app.choose-school');
    }
}
