<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserPostRequest;
use App\Http\Requests\UpdateUserPostRequest;
use App\Http\Requests\UpdateProfilePostRequest;
use App\Http\Requests\UpdatePasswordPostRequest;
use App\User;
use App\Department;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{

    public function index(\Illuminate\Http\Request $req)
    {
        $auth = Auth::user();
        if(is_null($auth)){
            $auth=new User();
        }
        if ($req->has('order') && $req->has('field')) {
            //If user sorted:
            $sort['order'] = $req->order;
            $sort['field'] = $req->field;
        }
        else
        {   //If user didn't sort, default to:
            $sort['order'] = 'DESC';
            $sort['field'] = 'users.id';
        }

        if ($req->has('search')) {
            $sort['search'] = $req->search;
            $users = User::select('users.*')->leftJoin('departments', 'users.department_id', '=', 'departments.id')
                ->where('users.name','like','%'.$sort['search'].'%')->orWhere('users.id','=',$sort['search'])->orWhere('users.phone','=',$sort['search'])
                ->orWhere('users.email','like','%'.$sort['search'].'%')->orWhere('departments.name','like','%'.$sort['search'].'%')
                ->orderBy($sort['field'], $sort['order'])
                ->paginate(20);
        } else {
            $users = User::select('users.*')->leftJoin('departments', 'users.department_id', '=', 'departments.id')
                ->orderBy($sort['field'], $sort['order']) //order/sort
                ->paginate(20);
        }

        $users->appends($req->input())->links();
        return view('users.index', compact('users', 'auth', 'sort'));
    }

    public function create()
    {
        $user = new User;
        $user->admin = 0;
        return view('users.add', compact('user'));
    }

    public function store(CreateUserPostRequest $request)
    {
        $user = new User();
        $user->fill($request->all());
        $user->admin = 0; //!!!!!!!!!
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('users.index')->with('success', 'user added successfully');
    }

    public function edit(User $user)
    {
        $departments= Department::All();
        return view('users.edit', compact('user', 'departments'));
    }

    public function update(UpdateUserPostRequest $request, User $user)
    {
        $user->fill($request->except('password'));
        $user->save();
        dd($request);
        dd($user);
        return redirect()->route('users.index')->with('success', 'user updated successfully');
    }

    public function editProfile()
    {
        $user=Auth::user();
        $departments= Department::All();
        return view('users.editProfile', compact('user', 'departments'));
    }

    public function updateProfile(UpdateProfilePostRequest $request)
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->presentation = $request->presentation;
        $path = $request->file('profile_photo')->store('public/profiles');
        $parts = explode('/', $path);
        $user->profile_photo = $parts[2];
        $user->save();
        return redirect()->route('dashboard')->with('success', 'profile updated successfully');
    }

    public function updatePassword(UpdatePasswordPostRequest $request)
    {
        $user = Auth::user();
        if(Hash::check($request->oldPassword, $user->password)){
            $user->password = bcrypt($request->newPassword);
            $user->save();
            return redirect()->route('dashboard')->with('success', 'password updated successfully');
        }
        return redirect()->route('users.editProfile');
    }

    public function profile(User $user)
    {
        return view('users.profile', compact('user'));
    }

    public function block(User $user, $block)
    {
        $user->blocked=$block;
        $user->save();
        if($block)
            return redirect()->route('users.index')->with('success', 'user blocked successfully');
        else
            return redirect()->route('users.index')->with('success', 'user unblocked successfully');
    }

    public function admin(User $user, $admin)
    {
        $user->admin=$admin;
        $user->save();
        if($admin)
            return redirect()->route('users.index')->with('success', 'Administrator profile assigned successfully');
        else
            return redirect()->route('users.index')->with('success', 'Removal of Administrator profile successfully');
    }

}
