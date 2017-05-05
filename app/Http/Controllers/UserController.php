<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Hash;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('users.index', compact('users'));
    }

    public function create()
    {
        $user = new User;
        return view('users.add', compact('user'));
    }

    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|alpha',
            'email' => 'required|email',
            'password' => 'required|min:8|confirmed'
        ]);
        $user = new User();
        $user->fill($request->all());
        $user->admin = 1;
        $user->password = Hash::make($request->password);
        $user->save();
        return redirect()->route('users.index')->with('success', 'user added successfully');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();
        return redirect()->route('users.index')->with('success', 'user deleted successfully');
    }

    public function edit()
    {
        return view('users.edit', compact('user'));
    }
}
