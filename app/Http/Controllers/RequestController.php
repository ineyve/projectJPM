<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\StoreRequestPostRequest;
use App\Http\Requests\StoreCompletePostRequest;
use App\Http\Requests\UpdateRequestPostRequest;
use App\Request;
use App\Printer;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;

class RequestController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(\Illuminate\Http\Request $req)
    {
        if ($req->has('order') && $req->has('field')) {
            //If user sorted:
            $sort['order'] = $req->order;
            $sort['field'] = $req->field;
        } else {   //If user didn't sort, default to:
            $sort['order'] = 'ASC';
            $sort['field'] = 'requests.status';
        }

        if ($req->has('search')) { //With or without search
            $sort['search'] = $req->search;
            $sort['search'] = strtolower($sort['search']);
            if (strpos('pending', $sort['search'])!==false) {
                $searchStatus = 0;
            } elseif (strpos('rejected', $sort['search'])!==false) {
                $searchStatus = 1;
            } elseif (strpos('complete', $sort['search'])!==false) {
                $searchStatus = 2;
            } else {
                $searchStatus = -1;
            }

            $requests = Request::select('requests.*')->leftJoin('users', 'users.id', '=', 'requests.owner_id')
                ->where('name', 'like', '%'.$sort['search'].'%')->orWhere('requests.id', '=', $sort['search'])
                ->orWhere('owner_id', '=', $sort['search'])->orWhereDate('due_date', '=', $sort['search'])
                ->orWhere('requests.status', '=', $searchStatus)
                ->orderBy($sort['field'], $sort['order'])->paginate(20);
        } else {
            $requests = Request::select('requests.*')->leftJoin('users', 'users.id', '=', 'requests.owner_id')
                ->orderBy($sort['field'], $sort['order'])->paginate(20);
        }

        $requests->appends($req->input())->links();
        return view('print_requests.index', compact('requests', 'sort'));
    }

    public function create()
    {
        return view('print_requests.add');
    }

    public function store(StoreRequestPostRequest $req)
    {
        $request = new Request();
        $request->owner_id = Auth::user()->id;
        $request->status = 0;
        $request->fill($req->all());
        $path = $req->file('file')->store('print-jobs/'.$request->owner_id);
        $parts = explode('/', $path);
        $request->file = $parts[2];
        $request->save();
        return redirect()->route('dashboard')->with('success', 'Request added sucessfuly!');
    }

    public function edit(Request $request)
    {
        if ($request->status == 0) {
            return view('print_requests.edit', compact('request'));
        }
        abort(404);
    }

    public function update(UpdateRequestPostRequest $req, Request $request)
    {
        $request->fill($req->all());
        if ($req->hasFile('file')) {
            Storage::delete('print-jobs/' . $request->owner_id . '/' . $request->file);
            $path = $req->file('file')->store('print-jobs/' . $request->owner_id);
            $parts = explode('/', $path);
            $request->file = $parts[2];
        }
        $request->save();

        return redirect()->route('dashboard')->with('success', 'request updated successfully!');
    }

    public function details(Request $request)
    {
        $admin = 0;
        if (Auth::user()->admin) {
            $admin = 1;
        }
        $user = Auth::user()->id;
        $printers= Printer::All();
        $comments = Comment::where('request_id', '=', $request->id)->orderBy('created_at')->get();
        return view('print_requests.details', compact('request', 'admin', 'comments', 'user', 'printers'));
    }

    public function complete(StoreCompletePostRequest $req, Request $request)
    {
        $request->status = 2;
        $request->closed_date = Carbon::now();
        $request->closed_user_id = Auth::user()->id;
        $request->user->print_counts += $request->quantity;
        $request->printer_id = $req->printer_id;
        $request->save();
        $request->user->save();

        return back()->with('success', 'Request completed!');
    }

    public function rating(Request $request, $rating)
    {
        if (is_null($request->satisfaction_grade)) {
            $user = Auth::user();
            $user->print_evals++;
            $user->save();
        }
        $request->satisfaction_grade = $rating;
        $request->save();

        return redirect()->route('dashboard')->with('success', 'Rating changed sucessfuly!');
    }

    public function refuse(\Illuminate\Http\Request $req, Request $request)
    {
        $request->status = 1;
        $request->closed_date = Carbon::now();
        $request->closed_user_id = Auth::user()->id;
        $request->refused_reason = $req->refused_reason;
        $request->save();

        return redirect()->back()->with('success', 'request rejected!');
    }

    public function destroy(Request $request)
    {
        Storage::delete('print-jobs/' . $request->owner_id . '/' . $request->file);
        $request->delete();
        return redirect()->route('dashboard')->with('success', 'request deleted successfully!');
    }

    public function download(Request $request)
    {
        return Response::download('../storage/app/print-jobs/'.$request->owner_id.'/'.$request->file);
    }
}
