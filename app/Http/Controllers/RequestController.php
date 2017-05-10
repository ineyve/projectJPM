<?php

namespace App\Http\Controllers;


use App\Http\Requests\StoreRefusePostRefuse;
use App\Http\Requests\StoreRequestPostRequest;

use App\Request;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class RequestController extends Controller
{
   
    public function index()
    {
        $requests = Request::paginate(20);
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
        if($request->owner_id == Auth::user()->id || Auth::user()->admin)
            return view('print_requests.details', compact('request'));
        else
            abort(403);
    }

    public function status(Request $request, $status, $from)
    {
        $request->status = $status;
        if($status == -1 || $status == 3){
            $request->closed_date = Carbon::now();
            $request->closed_user_id = Auth::user()->id;
        }
        $request->save();
        if($from == 0)
            return redirect()->route('requests.index')->with('success', 'Status changed sucessfuly!');
        else
            return redirect()->route('requests.details', $request)->with('success', 'Status changed sucessfuly!');
    }

    public function refuse(StoreRefusePostRefuse $req, Request $request)
    {
        $request->status = -1;
        $request->refused_reason = $req->refused_reason;
        $request->save();
        return view('print_requests.details', compact('request'));
    }

    public function refuseForm(Request $request)
    {
        return view('print_requests.refuse', compact('request'));
    }

    public function destroy(Request $request)
    {
        $request->delete();
        return redirect()->route('dashboard')->with('success', 'request deleted successfully');

    }
    
}