<?php

namespace App\Http\Controllers;

use App\Designation;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreDesignation;
use App\Http\Requests\UpdateDesignation;

class DesignationController extends Controller
{
    public function index()
    {
        return view('designation.index');
    }

    public function ssd(Request $request)
    {
        $designations = Designation::query();

        return Datatables::of($designations)
            ->addColumn('action', function ($each) {
                $edit_icon = '';
                $delete_icon = '';
                    $edit_icon = '<a href="' . route('designation.edit', $each->id) . '" class="text-warning"><i class="far fa-edit"></i></a>';
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
        return view('Designation.create');
    }

    public function store(StoreDesignation $request)
    {
        $designation = new Designation();
        $designation->title = $request->title;
        $designation->save();

        return redirect()->route('designation.index')->with('create', 'Designation is successfully created.');
    }

    public function edit($id)
    {
        $designation = Designation::findOrFail($id);
        return view('designation.edit', compact('Designation'));
    }

    public function update($id, UpdateDesignation $request)
    {
        if($id ==1)
        {
            return back()->withErrors(['fail' => 'HR Designation cannot be Updated.'])->withInput();
        }
        $designation = Designation::findOrFail($id);
        $designation->title = $request->title;
        $designation->update();

        return redirect()->route('designation.index')->with('update', 'Designation is successfully updated.');
    }

    public function destroy($id)
    {
        if($id == 2)
        {
            return back()->withErrors(['fail' => 'HR Designation cannot be deleted.'])->withInput();
        }
        else{
            $designation = Designation::findOrFail($id);
            $designation->delete();
        }
        return 'success';
    }
}
