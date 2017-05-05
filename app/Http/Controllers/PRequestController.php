<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 

use App\PRequest;


class PRequestController extends Controller
{
   
    public function index()
    {
        $requests = PRequest::all();
        return view('print_requests.index', compact('requests'));
    }

    public function create()
    {
        $request = new Request();
        return view('print_requests.add', compact('request'));
    }

    public function store(Request $rqt)
    {
        $this->validate($rqt, [
            'description'=>'required|alpha', //alpha??
            'request_date'=>'required|date',  //date??
            'due_date'=>'date',
            'quantity'=>'required',
            'colored'=>'required',
            'stapled'=>'required',
            'paper_size'=>'required',
            'paper_type'=>'required',
            'file'=>'required',
            ]);

        $request = new Request();
        $request->fill($rqt->all()); // o metodo fill preeenche todos os campos logo
        $request->save();
        return redirect()->route('print_requests.index')->with('success', 'Request added sucessfuly!');
    }

}