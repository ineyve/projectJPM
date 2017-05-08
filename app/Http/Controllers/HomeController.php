<?php

namespace App\Http\Controllers;

use App\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $requests = DB::select(DB::raw("SELECT * FROM requests WHERE owner_id = " . Auth::user()->id));
        $user = Auth::user();
        return view('home', compact('requests', 'user'));
    }
}
