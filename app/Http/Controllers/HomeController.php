<?php

namespace App\Http\Controllers;

use App\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function homeGraph()
    {

        $dpnames = "["; //Array with departments' names
        $dpcounts = "["; //Array with amount of requests per department
        $dcolors = "["; //Array with colors

        $prints_per_department = DB::select(DB::raw("SELECT d.name AS depname, u.department_id AS dep_id, count(department_id) AS cnt FROM (SELECT * FROM requests WHERE status = 2 OR status = 3) r JOIN users u ON r.owner_id = u.id JOIN departments d ON d.id = u.department_id GROUP BY u.department_id"));

        foreach ($prints_per_department as $stat)
        {
            $dpnames = $dpnames.'"'.$stat->depname.'", '; //Department's name

            $counter = $stat->cnt; //Amount of finished prints
            $dpcounts = $dpcounts.$counter.', ';

            $dcolors = $dcolors.'\'rgba('.rand(0,255).', '.rand(0,255).', '.rand(0,255).', 0.6)\', '; //Color of each bar
        }

        $statistics['departments'] = $dpnames.']'; //Departments' names
        $statistics['departmentscount'] = $dpcounts.']'; //Print number per department
        $statistics['departmentscolor'] = $dcolors.']'; //Bar colors
        $statistics['grayscale'] = Request::where('colored','=','0')->count(); //Amount of grayscale prints
        $statistics['colored'] = Request::where('colored','=','1')->count(); //Amount of colored prints
        $statistics['requestscount'] = Request::All()->count(); //Amount of requests

        return view('welcome', compact('statistics'));
    }
}
