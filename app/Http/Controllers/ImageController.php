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
        
        Image::make($path)->crop((int)($req->w*$ratioW), (int)($req->h*$ratioH),
            (int)($req->x*$ratioW), (int)($req->y*$ratioH))->resize((int)($req->w*720/$req->h),720)->save($path);
        return redirect()->route('dashboard');
    }
}
