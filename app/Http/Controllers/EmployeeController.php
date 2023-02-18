<?php

namespace App\Http\Controllers;

use App\User;
use Carbon\Carbon;
use App\Department;
use App\Designation;
use Illuminate\Http\Request; 
use Yajra\Datatables\Datatables;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreEmployee;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UpdateEmployee;
use Illuminate\Support\Facades\Storage;

class EmployeeController extends Controller
{
    public function index(){
        return view('employee.index');
    }

    public function ssd(Request $request){
        //User::queryနဲ့ ဆွဲထုတ်လည်း ရတယ်။ 
        //သူက user အကုန်လုံးစာအတွက်တစ်ခါ
        //user တစ်ယောက်ချင်းစီ ချိတ်ထားတဲ့ table ခေါ်တဲ့ query ကတစ်ခါ runနေရတာ ကြာတယ်။

        $employees = User::with('department','designation')->where('is_present','1');

        return Datatables::of($employees)
        ->editColumn('profile_img', function ($each) {
            return '<div id="employee-img">
                        <img src="' . $each->profile_img_path() . '" alt="" 
                        class="profile-thumbnail"><p class="my-1">' . $each->name . '</p>
                    </div>';
        })
        ->addColumn('department_name', function($each){
            return  $each->department ? $each->department->title : '-';
        })
        ->addColumn('designation_name', function($each){
            return  $each->designation ? $each->designation->title : '-';
        })
        ->editColumn('is_present',function($each){
            if($each->is_present == 1){
                return '<span class="badge badge-pill badge-success">Present</span>';
            }else{
                return '<span class="badge badge-pill badge-danger">Leave</span>';
            }   
        })
        ->editColumn('updated_at',function($each){
            return Carbon::parse($each->updated_at)->format('Y-m-d H:i:s');
        })
        ->addColumn('action',function($each){
            $edit_icon = '<a href="'.route('employee.edit',$each->id).'" class="text-warning"><i class="far fa-edit"></i></a>';
            $info_icon = '<a href="'.route('employee.show',$each->id).'" class="text-primary"><i class="fas fa-info-circle"></i></a>';
            $delete_icon = '<a href="#" class="text-danger delete-btn"><i class="fas fa-trash"></i></a>';

            return '<div class="action-icon">'.$edit_icon.$info_icon.$delete_icon.'</div>';
        })
        ->addColumn('plus_icon',function($each){
            return null;
        })
        ->rawColumns(['is_present','action','profile_img']) //html code အလုပ်လုပ်ဖို့
        ->make(true);
    }

    public function create(){
        $departments = Department::orderBy('title')->get();
        $designations = Designation::orderBy('title')->get();
        $user_id = User::orderBy('id','desc')->first()->id +1;
        return view('employee.create',compact('departments','designations','user_id'));
    }

    public function store(Request $request){ 
        $profile_img_name = null;
        if($request->hasFile('profile_img'))
        {
            $profile_img_file = $request->file('profile_img');
            $profile_img_name = uniqid().'_'.time().'.'. $profile_img_file->getClientOriginalExtension();
            Storage::disk('public')->put('employee/'.$profile_img_name, file_get_contents($profile_img_file));
        }  
        $employee = new User();
        $employee->employee_id = $request->employee_id;
        $employee->name = $request->name;
        $employee->phone = $request->phone;
        $employee->email = $request->email;
        $employee->nrc_number = $request->nrc_number;
        $employee->gender = $request->gender;
        $employee->birthday = $request->birthday;
        $employee->address = $request->address;
        $employee->department_id = $request->department_id;
        $employee->designation_id = $request->designation_id;
        $employee->date_of_join = $request->date_of_join;
        $employee->is_present = $request->is_present;
        $employee->profile_img = $profile_img_name;
        $employee->password = Hash::make('Smart!999');
        $employee->save();

        return redirect()->route('employee.index')->with('create','Employee is successfully created.');
    }

    public function edit($id){
        $employee = User::findOrFail($id);
        $departments = Department::orderBy('title')->get();
        $designations = Designation::orderBy('title')->get();
        return view('employee.edit',compact('employee','departments','designations'));
    }


    public function update($id,Request $request){
        $employee = User::findOrFail($id);

        $profile_img_name = $employee->profile_img;
        if ($request->hasFile('profile_img')) {
            Storage::disk('public')->delete('employee/' . $employee->profile_img);

            $profile_img_file = $request->file('profile_img');
            $profile_img_name = uniqid() . '_' . time() . '.' . $profile_img_file->getClientOriginalExtension();
            Storage::disk('public')->put('employee/' . $profile_img_name, file_get_contents($profile_img_file));
        }

        $employee->employee_id = $request->employee_id;
        $employee->name = $request->name;
        $employee->phone = $request->phone;
        $employee->email = $request->email;
        $employee->nrc_number = $request->nrc_number;
        $employee->gender = $request->gender;
        $employee->birthday = $request->birthday;
        $employee->address = $request->address;
        $employee->department_id = $request->department_id;
        $employee->designation_id = $request->designation_id;
        $employee->date_of_join = $request->date_of_join;
        $employee->is_present = $request->is_present;
        $employee->profile_img = $profile_img_name;
        $employee->update();
        return redirect()->route('employee.index')->with('update', 'Employee is successfully updated.');
    } 

    public function show($id){
        $employee = User::findorFail($id);
        return view('employee.show',compact('employee'));
    }
}

