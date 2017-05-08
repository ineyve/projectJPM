<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreRequestPostRequest;

use App\Request;

use Illuminate\Support\Facades\Auth;


class RequestController extends Controller
{
   
    public function index()
    {
        $requests = Request::all();
        return view('print_requests.index', compact('requests')); 
    }

    public function create()
    {
        $request = new Request();
        return view('print_requests.add', compact('request'));
    }

    public function store(StoreRequestPostRequest $req)
    {
        $request = new Request();
        $request->owner_id = Auth::user()->id;
        $request->status = 0;
        $request->fill($req->all()); // o metodo fill preeenche todos os campos logo
        $request->save();
        return redirect()->route('requests.index')->with('success', 'Request added sucessfuly!');
    }

    public function edit(Request $request)
    {
        return view('print_requests.edit', compact('request'));
    }

    public function details(Request $request)
    {
        return view('print_requests.details', compact('request'));
    }

    public function status(Request $request, $status, $from)
    {
        $request->status = $status;
        $request->save();
        if($from == 0)
            return redirect()->route('requests.index')->with('success', 'Status changed sucessfuly!');
        else
            return redirect()->route('requests.details', $request)->with('success', 'Status changed sucessfuly!');
    }
    
}