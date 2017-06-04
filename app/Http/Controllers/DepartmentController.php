<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreDepartmentPostRequest;
use App\Department;

class DepartmentController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin');
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
                ->orWhereDate('updated_at', '=', $sort['search'])
                ->orderBy($sort['field'], $sort['order'])->paginate(20);
        } else {
            $departments = Department::orderBy($sort['field'], $sort['order'])->paginate(20);
        }

        $departments->appends($req->input())->links();
        return view('departments.index', compact('departments', 'sort'));
    }

    public function create()
    {
        return view('departments.add');
    }

    public function store(StoreDepartmentPostRequest $req)
    {
        $department = new Department();
        $department->fill($req->all());
        $department->save();
        return redirect()->route('departments.index')->with('success', 'Department added sucessfuly!');
    }

    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    public function update(StoreDepartmentPostRequest $req, Department $department)
    {
        $department->name = $req->name;
        $department->save();

        return redirect()->route('departments.index')->with('success', 'Department updated successfully!');
    }
}
