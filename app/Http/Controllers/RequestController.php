<?php

namespace App\Http\Controllers;


use App\Comment;
use App\Http\Requests\StoreRefusePostRequest;
use App\Http\Requests\StoreRequestPostRequest;
use App\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;


class RequestController extends Controller
{

    public function index(\Illuminate\Http\Request $req)
    {
        if ($req->has('order') && $req->has('field')) {
            //If user sorted:
            $sort['order'] = $req->order;
            $sort['field'] = $req->field;
        }
        else
        {   //If user didn't sort, default to:
            $sort['order'] = 'DESC';
            $sort['field'] = 'requests.id';
        }

        if ($req->has('search')) { //With or without search
            $sort['search'] = $req->search;
            $requests = Request::select('requests.*')->leftJoin('users', 'users.id', '=', 'requests.owner_id')
                ->where('name','like','%'.$sort['search'].'%')->orWhere('requests.id','=',$sort['search'])
                ->orWhere('owner_id','=',$sort['search'])->orWhereDate('due_date','=',$sort['search'])
                ->orderBy($sort['field'], $sort['order'])->paginate(20);
        } else {
            $requests = Request::select('requests.*')->leftJoin('users', 'users.id', '=', 'requests.owner_id')
                ->orderBy($sort['field'], $sort['order'])->paginate(20);
        }

        $requests->appends($req->input())->links();
        return view('print_requests.index', compact('requests','sort'));
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
        $path = $req->file('file')->store('print-jobs/'.$request->owner_id);
        $parts = explode('/', $path);
        $request->file = $parts[2];
        $request->save();
        return redirect()->route('requests.index')->with('success', 'Request added sucessfuly!');
    }

    public function edit(Request $request)
    {
        return view('print_requests.edit', compact('request'));
    }

    public function details(Request $request)
    {
        $admin = 0;
        $user = Auth::user()->id;
        $comments = Comment::where('request_id', '=', $request->id)->orderBy('created_at')->get();
        if (Auth::user()->admin)
            $admin = 1;
        if ($request->owner_id == $user || $admin) {
            return view('print_requests.details', compact('request', 'admin', 'comments', 'user'));
        } else
            abort(403);
    }

    public function complete(Request $request)
    {
        $request->status = 2;
        $request->closed_date = Carbon::now();
        $request->closed_user_id = Auth::user()->id;
        $request->user->print_counts += $request->quantity;
        $request->save();
        $request->user->save();

        return back()->with('success', 'Status changed sucessfuly!');
    }

    public function rating(Request $request, $rating)
    {
        if(is_null($request->satisfaction_grade)) {
            $user = Auth::user();
            $user->print_evals++;
            $user->save();
        }
        $request->satisfaction_grade = $rating;
        $request->save();

        return redirect()->route('dashboard')->with('success', 'Rating changed sucessfuly!');
    }

    public function refuse(StoreRefusePostRequest $req, Request $request)
    {
        $request->status = 1;
        $request->closed_date = Carbon::now();
        $request->closed_user_id = Auth::user()->id;
        $request->refused_reason = $req->refused_reason;
        $request->save();

        $admin = 1;
        return view('print_requests.details', compact('request', 'admin'));
    }

    public function destroy(Request $request)
    {
        Storage::delete($request->file);
        $request->delete();
        return redirect()->route('dashboard')->with('success', 'request deleted successfully');
    }

    public function download(Request $request)
    {
        return Response::download('../storage/app/print-jobs/'.$request->owner_id.'/'.$request->file);
    }
}