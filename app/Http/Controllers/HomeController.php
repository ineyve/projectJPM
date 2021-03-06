<?php

namespace App\Http\Controllers;

use App\Department;
use App\Request;
use Exception;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    public function homeGraph(\Illuminate\Http\Request $req)
    {
        if ($req->has('department') && $req->department!=0) {
            $selected=$req->department;

            /* TEXT STATISTICS */
            $grayScale = Request::leftJoin('users', 'users.id', '=', 'requests.owner_id')
                ->where('colored', '=', '0')->where('status', 2)->where('users.department_id', $selected)
                ->sum('quantity'); //Amount of grayscale prints
            $colored = Request::leftJoin('users', 'users.id', '=', 'requests.owner_id')
                ->where('colored', '=', '1')->where('status', 2)->where('users.department_id', $selected)
                ->sum('quantity'); //Amount of colored prints
            $total = $colored + $grayScale;
            /* END */

            /* PIE CHART */
            $statistics['printsTotalCount'] = $total; //Amount of completed prints from all time
            $statistics['printsToday']= Request::whereDate('closed_date', '=', date('Y-m-d'))->where('status', 2)->where('id', $selected)->sum('quantity'); //Prints today
            $statistics['printsMonthlyAverage']= Request::whereMonth('closed_date', '=', date('m'))->where('status', 2)->where('id', $selected)->sum('quantity') / date('d'); //Prints today
            /* END */
        } else {
            $selected = 0;
            /* CODE TO GENERATE BAR GRAPH'S DATA */
            $printsPerDepartment = $this->getPrintsPerDepartment();
            $dpnames = "["; //Array with departments' names
            $dpcounts = "["; //Array with amount of requests per department
            $dpcolors = "["; //Array with colors
            foreach ($printsPerDepartment as $stat) {
                $dpnames .='"'.$this->autoLabelSpaces($stat->depname).'", '; //Department's name

                $counter = $stat->cnt; //Amount of finished prints
                $dpcounts .=$counter.', ';

                $dpcolors .='\'rgba('.rand(50, 200).', '.rand(50, 200).', '.rand(50, 200).', 1)\', '; //Color of each bar
            }
            $statistics['departments'] = $dpnames.']'; //Departments' names
            $statistics['departmentsCount'] = $dpcounts.']'; //Print number per department
            $statistics['departmentsColor'] = $dpcolors.']'; //Bar colors
            /* END */

            /* TEXT STATISTICS */
            $grayScale = Request::where('colored', '=', '0')->where('status', 2)->sum('quantity'); //Amount of grayscale prints
            $colored = Request::where('colored', '=', '1')->where('status', 2)->sum('quantity'); //Amount of colored prints
            $total = $colored + $grayScale;
            /* END */

            /* PIE CHART */
            $statistics['printsTotalCount'] = $total; //Amount of completed prints from all time
            $statistics['printsToday']= Request::whereDate('closed_date', '=', date('Y-m-d'))->where('status', 2)->sum('quantity'); //Prints today
            $statistics['printsMonthlyAverage']= Request::whereMonth('closed_date', '=', date('m'))->where('status', 2)->sum('quantity') / date('d'); //Prints today
            /* END */
        }

        if ($total != 0) {
            $statistics['grayScale'] = round(100 * $grayScale / $total); //% of grayscale prints
            $statistics['colored'] = round(100 * $colored / $total); //% of colored prints
        } else {
            $statistics['grayScale'] = 50;
            $statistics['colored'] = 50;
        }

        $departments=Department::All();
        return view('welcome', compact('statistics', 'departments', 'selected'));
    }

    public function unavailable()
    {
        try {
            DB::connection()->getPdo();
        } catch (Exception $e) {
            return view('unavailable');
        }
        return redirect()->route('home');
    }

    public function getPrintsPerDepartment()
    {
        return DB::select(DB::raw("SELECT d.name AS depname, u.department_id AS dep_id, sum(quantity) AS cnt FROM (SELECT * FROM requests WHERE status = 2) r JOIN users u ON r.owner_id = u.id JOIN departments d ON d.id = u.department_id GROUP BY u.department_id"));
    }

    public function autoLabelSpaces($string) //Prevents bar graph's labels from being cut off
    {
        $amount = round(strlen($string)/3);
        $spaces = '';
        for ($i = 0; $i < $amount; $i++) {
            $spaces .= ' ';
        }
        return $spaces.$string;
    }
}
