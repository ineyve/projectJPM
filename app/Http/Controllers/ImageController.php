<?php

namespace App\Http\Controllers;

use App\User;
use Intervention\Image\Facades\Image;

class ImageController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user)
    {
        return view('users.cropProfileImage', compact('user'));
    }
    public function crop(\Illuminate\Http\Request $req, User $user)
    {
        $path = public_path('/storage/profiles/'.$user->profile_photo);
        Image::make($path)->crop($req->w, $req->h, $req->x, $req->y)->save($path);
        return redirect()->route('dashboard');
    }
}
