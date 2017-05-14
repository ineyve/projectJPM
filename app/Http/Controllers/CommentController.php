<?php

namespace App\Http\Controllers;


use App\Comment;
use App\Http\Requests\StoreCommentPostRequest;
use App\Http\Requests\StoreRefusePostRequest;
use App\Http\Requests\StoreRequestPostRequest;

use App\Request;

use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;


class CommentController extends Controller
{

    public function create(StoreCommentPostRequest $req, Request $request)
    {
        $comment = new Comment();
        $comment->comment = $req->comment;
        $comment->blocked = 0;
        $comment->request_id = $request->id;
        $comment->user_id = Auth::user()->id;
        $comment->save();
        $comments = Comment::where('request_id', '=', $request->id)->orderBy('created_at')->get();

        $admin=0;
        if (Auth::user()->admin)
            $admin = 1;
        return view('print_requests.details', compact('request', 'admin', 'comments'));
    }
    
}