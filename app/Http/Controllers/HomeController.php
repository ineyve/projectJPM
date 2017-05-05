<?php

namespace App\Http\Controllers;

use App\PRequest;
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
        $requests = PRequest::all();
        $user = Auth::user();
        return view('home', compact('requests', 'user'));
    }
}
