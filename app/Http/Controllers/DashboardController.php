<?php

namespace App\Http\Controllers;

use App\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(\Illuminate\Http\Request $req)
    {
        $user = Auth::user();

        if ($req->has('order') && $req->has('field')) {
            //If user sorted:
            $sort['order'] = $req->order;
            $sort['field'] = $req->field;
        } else {   //If user didn't sort, default to:
            $sort['order'] = 'ASC';
            $sort['field'] = 'requests.status';
        }

        if ($req->has('search')) { //With or without search
            $sort['search'] = $req->search;
            $sort['search'] = strtolower($sort['search']);
            if (strpos('pending', $sort['search'])!==false) {
                $searchStatus = 0;
            } elseif (strpos('rejected', $sort['search'])!==false) {
                $searchStatus = 1;
            } elseif (strpos('complete', $sort['search'])!==false) {
                $searchStatus = 2;
            } else {
                $searchStatus = -1;
            }

            $requests = Request::where('owner_id', '=', $user->id)
            ->where('id', '=', $sort['search'])->orWhere('description', 'like', '%'.$sort['search'].'%')
            ->orWhere('status', '=', $searchStatus)->orWhereDate('due_date', '=', $sort['search'])
            ->orderBy($sort['field'], $sort['order'])
            ->paginate(20);
        } else {
            $requests = Request::where('owner_id', '=', $user->id)
            ->orderBy($sort['field'], $sort['order'])
            ->paginate(20);
        }

        $requests->appends($req->input())->links();
        return view('dashboard', compact('requests', 'user', 'sort'));
    }
}
