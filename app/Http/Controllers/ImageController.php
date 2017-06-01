<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Input;
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
        $file_name = $user->profile_photo;
        $path = public_path('/storage/profiles/'.$file_name);
        Image::make($path)->crop($req->w, $req->h, $req->x, $req->y)->save($path);
        return redirect()->route('dashboard');
    }
}
