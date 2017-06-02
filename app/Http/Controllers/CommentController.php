<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $comments=Comment::where('blocked', '=', '1')->paginate(20);
        return view('comments.index', compact('comments'));
    }

    public function create(\Illuminate\Http\Request $req, Request $request)
    {
        $comment = new Comment();
        $comment->fill($req->all());
        $comment->blocked = 0;
        $comment->request_id = $request->id;
        $comment->user_id = Auth::user()->id;
        $comment->save();

        return back();
    }

    public function reply(\Illuminate\Http\Request $req, Request $request, Comment $comment)
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

    public function block(Comment $comment, $block)
    {
        $comment->blocked=$block;
        $comment->save();
        if ($block) {
            return redirect()->back()->with('success', 'comment blocked successfully');
        } else {
            return redirect()->back()->with('success', 'comment unblocked successfully');
        }
    }
}
