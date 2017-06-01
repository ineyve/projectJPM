<?php

namespace App\Http\Controllers;

use App\Comment;
//use App\Http\Departments\StoreRefusePostRequest;
//use App\Http\Departments\StoreRequestPostRequest;
//use App\Http\Departments\StoreCompletePostRequest;
//use App\Http\Departments\UpdateRequestPostRequest;
use App\Department;
use Illuminate\Support\Facades\Auth;

class DepartmentController extends Controller
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
            $sort['field'] = 'departments.name';
        }

        if ($req->has('search')) { //With or without search
            $sort['search'] = $req->search;

            $departments = Department::where('name', 'like', '%'.$sort['search'].'%')->orWhere('id', '=', $sort['search'])
                ->orWhereDate('created_at', '=', $sort['search'])
                ->orderBy($sort['field'], $sort['order'])->paginate(20);
        } else {
            $departments = Department::orderBy($sort['field'], $sort['order'])->paginate(20);
        }

        $departments->appends($req->input())->links();
        return view('departments.index', compact('departments', 'sort'));
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
        return view('print_requests.edit', compact('request'));
    }

    public function update(UpdateRequestPostRequest $req, Request $request)
    {
        $request->description = $req->description;
        $request->quantity = $req->quantity;
        $request->stapled = $req->stapled;
        $request->paper_size = $req->paper_size;
        $request->paper_type = $req->paper_type;
        $request->front_back = $req->front_back;
        $request->colored = $req->colored;
        $request->due_date = $req->due_date;
        if ($req->hasFile('file')) {
            $path = $req->file('file')->store('print-jobs/' . $request->owner_id);
            $parts = explode('/', $path);
            $request->file = $parts[2];
        }
        $request->save();

        return redirect()->route('dashboard')->with('success', 'request updated successfully!');
    }
}
