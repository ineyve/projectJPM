<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Http\Requests\StorePrinterPostRequest;
use App\Printer;

class PrinterController extends Controller
{
    public function __construct()
    {
        $this->middleware('can:admin');
    }

    public function index(\Illuminate\Http\Request $req)
    {
        if ($req->has('order') && $req->has('field')) {
            //If user sorted:
            $sort['order'] = $req->order;
            $sort['field'] = $req->field;
        } else {   //If user didn't sort, default to:
            $sort['order'] = 'ASC';
            $sort['field'] = 'printers.name';
        }

        if ($req->has('search')) { //With or without search
            $sort['search'] = $req->search;

            $printers = Printer::where('name', 'like', '%'.$sort['search'].'%')->orWhere('id', '=', $sort['search'])
                ->orWhereDate('created_at', '=', $sort['search'])
                ->orWhereDate('updated_at', '=', $sort['search'])
                ->orderBy($sort['field'], $sort['order'])->paginate(20);
        } else {
            $printers = Printer::orderBy($sort['field'], $sort['order'])->paginate(20);
        }

        $printers->appends($req->input())->links();
        return view('printers.index', compact('printers', 'sort'));
    }

    public function create()
    {
        return view('printers.add');
    }

    public function store(StorePrinterPostRequest $req)
    {
        $printer = new Printer();
        $printer->fill($req->all());
        $printer->save();
        return redirect()->route('printers.index')->with('success', 'Printers added sucessfuly!');
    }

    public function edit(Printer $printer)
    {
        return view('printers.edit', compact('printer'));
    }

    public function update(StorePrinterPostRequest $req, Printer $printer)
    {
        $printer->name = $req->name;
        $printer->save();

        return redirect()->route('printers.index')->with('success', 'Printers updated successfully!');
    }
}
