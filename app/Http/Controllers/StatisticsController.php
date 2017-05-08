<?php

namespace App\Http\Controllers;

use App\Request;
use Illuminate\Support\Facades\DB;

class StatisticsController extends Controller
{
    public function homeGraph()
    {
        $statistics['grayscale'] = Request::where('colored','=','0')->count(); //Amount of grayscale prints
        $statistics['colored'] = Request::where('colored','=','1')->count(); //Amount of colored prints
        $statistics['requestscount'] = Request::All()->count(); //Amount of requests

        $dp = "["; //Array with departments' names
        $dc = "["; //Array with amount of requests per department
        $dcolors = "["; //Array with colors

        $departments = DB::select(DB::raw("SELECT d.name AS depname, u.department_id AS dep_id, count(department_id) AS cnt FROM (SELECT * FROM requests WHERE status = 2 OR status = 3) r JOIN users u ON r.owner_id = u.id JOIN departments d ON d.id = u.department_id GROUP BY u.department_id"));

        foreach ($departments as $department)
        {
            $dp = $dp.'"'.$department->depname.'", ';
            $counter = $department->cnt;
            $dc = $dc.$counter.', ';
            $dcolors = $dcolors.'\'rgba(242, 255, 0, 0.6)\', ';
        }

        $statistics['departments'] = $dp.']';
        $statistics['departmentscount'] = $dc.']';
        $statistics['departmentscolor'] = $dcolors.']';
        return view('welcome', compact('statistics'));
    }
}
