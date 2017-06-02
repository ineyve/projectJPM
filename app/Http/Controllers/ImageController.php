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
        dd($req);
        list($width, $height) = getimagesize($path);
        $ratioW = $width/$req->liveW;
        $retioH = $height/$req->liveH;

        Image::make($path)->crop($req->w*$ratioW, $req->h*$retioH, $req->x*$ratioW, $req->y*$retioH)->resize(abs($req->w*720/$req->h),720)->save($path);
        return redirect()->route('dashboard');
    }
}
