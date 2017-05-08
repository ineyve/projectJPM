<?php

namespace App\Http\Controllers;

use App\Request;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function index()
    {
        $statistics['grayscale'] = Request::where('colored','=','0')->count();
        $statistics['colored'] = Request::where('colored','=','1')->count();
        $statistics['requestscount'] = Request::All()->count();

        $dp = "[";
        $dc = "[";
        $dcolors = "[";

        $departments = DB::select(DB::raw("SELECT d.name AS depname, u.department_id AS dep_id, count(department_id) AS cnt FROM requests r JOIN users u ON r.owner_id = u.id JOIN departments d ON d.id = u.department_id GROUP BY u.department_id"));

        foreach ($departments as $department)
        {
            $dp = $dp.'"'.$department->depname.'", ';
            $counter = $department->cnt;
            $dc = $dc.$counter.', ';
            $dcolors = $dcolors.'\'rgba(255,99,132,1)\', ';
        }
        $dp = $dp.']';
        $dc = $dc.']';
        $dcolors = $dcolors.']';

        $statistics['departments'] = $dp;
        $statistics['departmentscount'] = $dc;
        $statistics['departmentscolor'] = $dcolors;
        return view('welcome', compact('statistics'));
    }
}
