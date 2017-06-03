<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:selfOrAdmin,request');
    }

    public function index(\Illuminate\Http\Request $req){
        if ($req->has('order') && $req->has('field')) {
            //If user sorted:
            $sort['order'] = $req->order;
            $sort['field'] = $req->field;
        } else {   //If user didn't sort, default to:
            $sort['order'] = 'DESC';
            $sort['field'] = 'comments.updated_at';
        }

        if ($req->has('search')) { //With or without search
            $sort['search'] = $req->search;
            $comments = Comment::select('comments.*')->leftJoin('users', 'users.id', '=', 'comments.user_id')->
            where('comments.blocked', '=', '1')
                ->where(function ($query) use ($sort) {
                    $query->where('comments.comment', 'like', '%'.$sort['search'].'%')
                        ->orWhere('users.name', 'like', '%'.$sort['search'].'%')
                        ->orWhere('comments.request_id', '=', $sort['search'])
                        ->orWhereDate('comments.updated_at', '=', $sort['search']);
                })->orderBy($sort['field'], $sort['order'])->paginate(20);
        } else {
            $comments=Comment::select('comments.*')->leftJoin('users', 'users.id', '=', 'comments.user_id')
                ->where('comments.blocked', '=', '1')->orderBy($sort['field'], $sort['order'])->paginate(20);
        }

        $comments->appends($req->input())->links();
        return view('comments.index', compact('comments','sort'));
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
