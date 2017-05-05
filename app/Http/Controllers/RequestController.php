<?php

namespace App\Http\Controllers;


use App\Requests\StoreRequestPostRequest;

use App\Request;


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
        $request->fill($req->all()); // o metodo fill preeenche todos os campos logo
        $request->save();
        return redirect()->route('request.index')->with('success', 'Request added sucessfuly!');
    }
    
}