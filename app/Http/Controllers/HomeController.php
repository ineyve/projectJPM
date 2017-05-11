<?php

namespace App\Http\Controllers;

use App\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function homeGraph()
    {
        /* CODE TO GENERATE BAR GRAPH'S DATA */
        $prints_per_department = $this->getPrintsPerDepartment();
        $dpnames = "["; //Array with departments' names
        $dpcounts = "["; //Array with amount of requests per department
        $dpcolors = "["; //Array with colors
        foreach ($prints_per_department as $stat)
        {
            $dpnames .='"'.$this->autoLabelSpaces($stat->depname).'", '; //Department's name

            $counter = $stat->cnt; //Amount of finished prints
            $dpcounts .=$counter.', ';

            $dpcolors .='\'rgba('.rand(50,200).', '.rand(50,200).', '.rand(50,200).', 1)\', '; //Color of each bar
        }
        $statistics['departments'] = $dpnames.']'; //Departments' names
        $statistics['departmentsCount'] = $dpcounts.']'; //Print number per department
        $statistics['departmentsColor'] = $dpcolors.']'; //Bar colors
        /* END */


        $grayScale = Request::where('colored','=','0')->whereIn('status', [2,3,4])->count(); //Amount of grayscale prints
        $colored = Request::where('colored','=','1')->whereIn('status', [2,3,4])->count(); //Amount of colored prints
        $total = $colored + $grayScale;

        if($total != 0) {
            $statistics['grayScale'] = round(100 * $grayScale / $total); //% of grayscale prints
            $statistics['colored'] = round(100 * $colored / $total); //% of colored prints
        }
        else {
            $statistics['grayScale'] = 50;
            $statistics['colored'] = 50;
        }
        $statistics['printsTotalCount'] = $total; //Amount of completed prints from all time
        $statistics['printsToday']= Request::whereDate('closed_date', '=', date('Y-m-d'))->whereIn('status', [2,3,4])->count(); //Prints today
        $statistics['printsMonthlyAverage']= Request::whereMonth('closed_date', '=', date('m'))->whereIn('status', [2,3,4])->count() / date('d'); //Prints today

        return view('welcome', compact('statistics'));
    }

    public function getPrintsPerDepartment()
    {
        return DB::select(DB::raw("SELECT d.name AS depname, u.department_id AS dep_id, count(department_id) AS cnt FROM (SELECT * FROM requests WHERE status = 2 OR status = 3) r JOIN users u ON r.owner_id = u.id JOIN departments d ON d.id = u.department_id GROUP BY u.department_id"));
    }

    public function autoLabelSpaces($string) //Prevents bar graph's labels from being cut off
    {
        $amount = round(strlen($string)/3);
        $spaces = '';
        for($i = 0; $i < $amount; $i++)
        {
            $spaces .= ' ';
        }
        return $spaces.$string;
    }
}
