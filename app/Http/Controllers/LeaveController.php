<?php

namespace App\Http\Controllers;

use App\User;
use App\Leave;
use Illuminate\Http\Request;
use Yajra\Datatables\Datatables;
use App\Http\Requests\StoreLeave;
use App\Http\Requests\UpdateLeave;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class LeaveController extends Controller
{
    public function index()
    { 
        return view('leave.index');
    }

    public function ssd(Request $request)
    {
        $leaves = Leave::query();

        return Datatables::of($leaves)
            ->filterColumn('employee_name', function ($query, $keyword) {
                $query->whereHas('employee', function ($q1) use ($keyword) {
                    $q1->where('name', 'like', '%' . $keyword . '%');
                });
            })
            
            ->addColumn('employee_name', function ($each) {
                return $each->employee ? $each->employee->name : '-';
            })
            ->editColumn('leave_type',function($each){
                if($each->leave_type == 0){
                    return '<p class="p-3 text-white" style="background:#32a8a6;">Causal Leave</p>';
                }
                if($each->leave_type == 1){
                    return '<p class="p-3 text-white" style="background:#fcba03;">Paternity Leave</p>';
                }
                if($each->leave_type == 2){
                    return '<p class="p-3 text-white" style="background:#03ebfc;">Medical Leave</p>';
                }
                if($each->leave_type == 3){
                    return '<p class="p-3 text-white" style="background:#02405f;">Without Salary Leave</p>';
                }
                if($each->leave_type == 4){
                    return '<p class="p-3 text-white" style="background:#d2fc03;">Earn Leave</p>';
                }
                if($each->leave_type == 5){
                    return '<p class="p-3 text-white" style="background:#034afc;">Study Leave</p>';
                }
                if($each->leave_type == 6){
                    return '<p class="p-3 text-white" style="background:#fc03b1;">Bereavement Leave</p>';
                }
                else{
                    return '<p class="badge badge-pill badge-danger">Unknown</p>';
                }   
            })
            ->addColumn('action', function ($each) {
                $edit_icon = '';
                $delete_icon = '';
                    $edit_icon = '<a href="' . route('leave.edit', $each->id) . '" class="text-warning"><i class="far fa-edit"></i></a>';
                    $delete_icon = '<a href="#" class="text-danger delete-btn" data-id="' . $each->id . '"><i class="fas fa-trash-alt"></i></a>';
                

                return '<div class="action-icon">' . $edit_icon . $delete_icon . '</div>';
            })
            ->addColumn('plus-icon', function ($each) {
                return null;
            })
            ->rawColumns(['action','leave_type'])
            ->make(true);
    }

    public function create()
    {
        $employees = User::orderBy("employee_id")->get();
        return view('leave.create', compact('employees'));
    }

    public function store(StoreLeave $request)
    {
        $request->from = date('Y-m-d', strtotime($request->from));
        $request->to = date('Y-m-d',strtotime($request->to));
        $has_leave_from = DB::select( DB::raw("select * from leaves where leaves.from BETWEEN '".$request->from."' and '".$request->to."' and leaves.user_id='".$request->user_id."'"));
        $has_leave_to = DB::select( DB::raw("select * from leaves where leaves.to BETWEEN '".$request->from."' and '".$request->to."' and leaves.user_id='".$request->user_id."'"));

        if($has_leave_from ==null || $has_leave_to ==null){
            $leave = new Leave();
            $leave->user_id = $request->user_id;
            $leave->from = $request->from;
            $leave->to = $request->to;
            $leave->leave_type = $request->leave_type;
            $leave->save();

            return redirect()->route('leave.index')->with('create', 'Leave is successfully created.');
        }
        return back()->withErrors(['fail' => 'Some of the days are already taken as leave.'])->withInput();

    }

    public function edit($id)
    {
        $leave = Leave::findOrFail($id);
        return view('leave.edit', compact('leave'));
    }

    public function update($id, UpdateLeave $request)
    {
        $leave = Leave::findOrFail($id);
        $leave->title = $request->title;
        $leave->update();

        return redirect()->route('leaveindex')->with('update', 'Leave is successfully updated.');
    }

    public function destroy($id)
    {
        $leave = Leave::findOrFail($id);
        $leave->delete();

        return 'success';
    }
    public function overview(){
        return view('leave.overview');
    }
}
