<?php

namespace App\Http\Controllers;

use App\Holiday;
use App\Department;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests\StoreHoliday;
use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateHoliday;

class HolidayController extends Controller
{
    public function index()
    {
        return view('holiday.index');
    }

    public function ssd(Request $request)
    {
        $holidays = Holiday::query();

        return Datatables::of($holidays)
            ->addColumn('action', function ($each) {
                $edit_icon = '';
                $delete_icon = '';
                    $edit_icon = '<a href="' . route('holiday.edit', $each->id) . '" class="text-warning"><i class="far fa-edit"></i></a>';
                    $delete_icon = '<a href="#" class="text-danger delete-btn" data-id="' . $each->id . '"><i class="fas fa-trash-alt"></i></a>';
                return '<div class="action-icon">' . $edit_icon . $delete_icon . '</div>';
            })
            ->addColumn('plus-icon', function ($each) {
                return null;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
       return view('holiday.create');
    }

    public function store(StoreHoliday $request)
    {
        $holiday = new Holiday();
        $holiday->title = $request->title;
        $holiday->date = $request->date;
        $holiday->save();

        return redirect()->route('holiday.index')->with('create', 'Holiday is successfully created.');
    }

    public function edit($id)
    {
        $holiday = Holiday::findOrFail($id);
        return view('holiday.edit', compact('holiday'));
    }

    public function update($id, Request $request)
    {
        $holiday = Holiday::findOrFail($id);
        $holiday->title = $request->title;
        $holiday->date = $request->date;
        $holiday->update();

        return redirect()->route('holiday.index')->with('update', 'Holiday is successfully updated.');
    }

    public function destroy($id)
    {
        $holiday = Holiday::findOrFail($id);
        $holiday->delete();

        return 'success';
    }
}
