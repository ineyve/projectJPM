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
        list($width, $height) = getimagesize($path);
        $ratioW = $width/$req->liveW;
        $ratioH = $height/$req->liveH;
        echo abs($req->w*$ratioW);
        echo abs($req->h*$ratioH);
        echo abs($req->x*$ratioW);
        echo abs($req->y*$ratioH);
        dd($ratioW);
        Image::make($path)->crop(abs($req->w*$ratioW), abs($req->h*$ratioH),
            abs($req->x*$ratioW), abs($req->y*$ratioH))->resize(abs($req->w*720/$req->h),720)->save($path);
        return redirect()->route('dashboard');
    }
}
