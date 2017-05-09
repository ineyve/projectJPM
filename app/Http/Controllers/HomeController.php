<?php

namespace App\Http\Controllers;

use App\Request;
use Illuminate\Support\Facades\Auth;

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
        $user = Auth::user();
        $requests = Request::where('owner_id', '=', $user->id)->get();
        return view('home', compact('requests', 'user'));
    }
}