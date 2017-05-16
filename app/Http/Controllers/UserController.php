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
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(\Illuminate\Http\Request $req)
    {
        $auth = Auth::user();
        if ($req->has('search')) {
            $srch = $req->search;
            $users = User::leftJoin('departments', 'users.department_id', '=', 'departments.id')
                ->where('users.name','like','%'.$srch.'%')->orWhere('users.id','=',$srch)->orWhere('users.phone','=',$srch)
                ->orWhere('users.email','like','%'.$srch.'%')->orWhere('departments.name','like','%'.$srch.'%')
                ->select('users.id')->addSelect('users.name')
                ->addSelect('users.email')->addSelect('departments.name')->addSelect('phone')->paginate(20);
        } else {
            $users = User::paginate(20);
        }

        if ($req->has('order')) {
            $order = $req->order;

        }
        $users->appends($req->input())->links();
        return view('users.index', compact('users', 'auth'));
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

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'user deleted successfully');
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
        return view('users.editProfile', compact('user'));
    }

    public function updateProfile(UpdateProfilePostRequest $request)
    {
        $user = Auth::user();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone = $request->phone;
        $user->presentation = $request->presentation;
        $path = $request->file('file')->store('public/profiles/');
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

}
