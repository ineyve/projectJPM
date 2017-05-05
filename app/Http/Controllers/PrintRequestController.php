<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request; 

use App\PrintRequest;


class PrintRequestController extends Controller
{
   
    public function index()
    {
        $print_requests = PrintRequest::all();
        return view('print_requests.index', compact('print_requests')); 
    }

    public function create()
    {
        $print_request = new PrintRequest();
        return view('print_requests.add', compact('print_request'));
    }

    public function store(Request $request)
    {
        $this->validate($request, [
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

        $print_request = new PrintRequest();
        $print_request->fill($request->all()); // o metodo fill preeenche todos os campos logo
        $print_request->save();
        return redirect()->route('print_request.index')->with('sucess', 'Request added sucessfuly!');
    }

}