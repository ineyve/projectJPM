<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateUserPostRequest;
use App\Http\Requests\UpdateUserPostRequest;
use App\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $user = new User;
        $user->admin = 0; //!!!!!!!!!
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

    public function update(UpdateUserPostRequest $request, User $user)
    {
        $user->fill($request->except('password'));
        $user->admin = 0; //!!!!!!!!
        $user->save();
        return redirect()->route('users.index')->with('success', 'user updated successfully');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('users.index')->with('success', 'user deleted successfully');
    }

    public function edit(User $user)
    {
        return view('users.edit', compact('user'));
    }

}
