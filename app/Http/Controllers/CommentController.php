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

        return back();
    }

    public function reply(StoreCommentPostRequest $req, Request $request, Comment $comment)
    {
        $reply = new Comment();
        $reply->comment = $req->reply;
        $reply->blocked = 0;
        $reply->request_id = $request->id;
        $reply->user_id = Auth::user()->id;
        $reply->parent_id = $comment->id;
        $reply->save();

        return back();
    }
    
}