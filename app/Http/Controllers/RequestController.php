<?php

namespace App\Http\Controllers;


use App\Comment;
use App\Http\Requests\StoreCommentPostRequest;
use App\Http\Requests\StoreRefusePostRequest;
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
        $admin=0;
        $comments = Comment::where('request_id', '=', $request->id)->orderBy('created_at')->get();
        if (Auth::user()->admin)
            $admin = 1;
        if($request->owner_id == Auth::user()->id || $admin) {
            return view('print_requests.details', compact('request', 'admin', 'comments'));
        }
        else
            abort(403);
    }

    public function status(Request $request, $status, $from)
    {
        $request->status = $status;
        if($status == -1 || $status == 4){
            $request->closed_date = Carbon::now();
            $request->closed_user_id = Auth::user()->id;
        }
        $request->save();
        if($from == 0)
            return redirect()->route('requests.index')->with('success', 'Status changed sucessfuly!');
        else
            return redirect()->route('requests.details', $request)->with('success', 'Status changed sucessfuly!');
    }

    public function rating(Request $request, $rating)
    {
        $request->satisfaction_grade = $rating;
        $request->save();

        return redirect()->route('dashboard')->with('success', 'Rating changed sucessfuly!');
    }

    public function refuse(StoreRefusePostRequest $req, Request $request)
    {
        $request->status = -1;
        $request->refused_reason = $req->refused_reason;
        $request->save();

        $admin=0;
        if (Auth::user()->admin)
            $admin = 1;
        return view('print_requests.details', compact('request', 'admin'));
    }

    public function destroy(Request $request)
    {
        $request->delete();
        return redirect()->route('dashboard')->with('success', 'request deleted successfully');

    }


    
}